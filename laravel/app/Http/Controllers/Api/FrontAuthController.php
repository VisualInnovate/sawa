<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\OTP;
use App\Models\User;
use App\Models\ChildParent;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\ParentResource;
use Spatie\Permission\Models\Permission;
use App\Notifications\SendOtpNotification;
use App\Notifications\AcceptBookingNotification;
use App\Http\Requests\Parent\UpdateProfileRequest;
use Modules\Child\Entities\Child;

class FrontAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = ChildParent::where('email', $request->email)->first();

        if ($user != null) {
            if (Hash::check($request->password, $user->password)) {
                $user->image = url($user->image);
                $response = [
                    'token' => $user->createToken($user->email)->plainTextToken,
                    'user' => $user,
                ];

                return response($response, 202);
            } else {
                return response()->json(["errors" => [
                    'email' => __('auth.failed')
                ]], 401);
            }
        } else {
            return response()->json(["errors" => [
                'email' => __('auth.failed')
            ]], 401);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string'],
            'lname' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique('parents', 'email')],
            'phone' => ['required', 'string', Rule::unique('parents', 'phone')],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        $parent = ChildParent::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);


        // $userRole = Role::where('name', 'user')->where('guard_name', 'parent')->first();
        // $parent->assignRole($userRole);
        $child_permissions = Permission::query()
            ->select('name')
            ->where('guard_name', 'parent')
            ->where('name', 'like', "%child%")
            ->pluck('name');
        $parent->givePermissionTo($child_permissions);


        $token = $parent->createToken($parent->email)->plainTextToken;

        $code = $this->sendFirstOTP($parent);

        return response()->json([
            'token' => $token,
            'user' => $parent,
            'code' => $code,
        ], 201);
    }

    public function user(Request $request)
    {
        $user = ParentResource::make($request->user('parent'));


        return response()->json(['user' => $user], 200);
    }

    public function logout(Request $request)
    {

        $request->user('parent')->tokens()->delete();

        $resposne = [
            'message' => "You have successfully been logged out!"
        ];

        return response($resposne, 200);
    }

    public function profile(UpdateProfileRequest $request)
    {
        $user = $request->user('parent');

        $data = $request->validated();

        if ($request->file('image')) {
            if (!empty($user->image)) {
                $currentImage = public_path() . $user->image;

                if (file_exists($currentImage)) {
                    unlink($currentImage);
                }
            }

            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();

            $name = time() . '.' . $extension;

            $request->image->move(public_path() . '/images/',  $name);

            $user->image = '/images/' . $name;

            $data['image'] = $user->image;
        }

        if (!empty($request->validated('password'))) {
            $data['password'] = Hash::make($request->validated('password'));
        }

        $user->update($data);

        return response()->json([
            'message' => 'profile updated successfully',
            'profile' => ParentResource::make($user->fresh())
        ], 202);
    }

    public function getParentNotification()
    {
        $user = auth('parent')->user();

        return response()->json([
            "notifications" => $user->notifications
        ], 200);
    }

    public function doctors(Request $request)
    {
        $doctors = User::select("name", "title", "image")->where('status', 2)->get();

        $doctors->map(function ($doctor) {
            $doctor->image = url($doctor->image);
        });

        return response()->json([
            "doctors" => $doctors
        ], 200);
    }

    public function sendFirstOTP(ChildParent $parent)
    {

        $otp = rand(100000, 999999);

        OTP::create([
            'identifier' => $parent->phone,
            'otp' => $otp,
            'expire_at' => Carbon::now()->addMinutes(10)
        ]);

        $response = Http::get(
            "https://josmsservice.com/SMSServices/Clients/Prof/RestSingleSMS_General/SendSMS?senderid=Visualinn&numbers=$parent->phone&accname=Visualinn&AccPass=DkAAnSg!GFYw20AJ&msg=$otp"
        );

        return  $response->status();
    }

    public function sendOTP(Request $request)
    {
        $user = $request->user('parent');

        OTP::query()
            ->where('identifier', $user->phone)
            ->delete();

        $otp = rand(100000, 999999);

        OTP::create([
            'identifier' => $user->phone,
            'otp' => $otp,
            'expire_at' => Carbon::now()->addMinutes(10)
        ]);

        $response = Http::get(
            "https://josmsservice.com/SMSServices/Clients/Prof/RestSingleSMS_General/SendSMS?senderid=Visualinn&numbers=$user->phone&accname=Visualinn&AccPass=DkAAnSg!GFYw20AJ&msg=$otp"
        );

        if ($response->status() == '200') {
            return response()->json([
                'otp' => $otp,
                'message' => $response->body()

            ], 200);
        } else {
            return response()->json([
                'message' => $response->status()
            ], 400);
        }
    }

    public function validateOTP(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'integer']
        ]);

        $user = $request->user('parent');

        $otp = OTP::query()
            ->where('identifier', $user->phone)
            ->where('valid', true)
            ->where('otp', $request->otp)
            ->first();

        if ($otp == null) {
            return response()->json([
                'message' => 'invalid otp'
            ], 401);
        }

        $otp_expire_at = Carbon::parse($otp->expire_at);
        $now = Carbon::now();

        if ($otp_expire_at->lessThan($now)) {

            $otp->delete();

            return response()->json([
                'message' => 'otp expired'
            ], 401);
        }

        $otp->valid = false;

        $otp->save();

        $user->phone_verified_at = Carbon::now();

        $user->save();

        return response()->json([
            'message' => 'otp validated successfully',
            'phone_verified_at' => Carbon::now()
        ], 200);
    }
}
