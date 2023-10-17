<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\SawaException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Role;

use function PHPSTORM_META\type;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:users.index|users.create|users.show|users.edit|roles-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:users.create', ['only' => ['store']]);
        $this->middleware('permission:users.show', ['only' => ['show']]);
        $this->middleware('permission:users.edit', ['only' => ['update']]);
        $this->middleware('permission:users.delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $users = User::where('name', 'LIKE', '%' . $request->keyword . '%')->with('roles')->orderBy('id', 'DESC')->paginate($request->size);
        $users->each(function ($user) {
            $user->image = $user->image ? url($user->image) : null;
        });
        return response([
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // return response(Guard::getDefaultName(static::class));
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => ['required', 'email', "unique:users,email"],
            'title' => 'required|string',
            'image' => 'required|image',
            'password' => ['required', 'min:6'],
            'role' => ['required']
        ]);

        if ($request->file('image')) {

            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();

            $name = date('y-d-m') . '-' . time() . '.' . $extension;

            $request->image->move(public_path() . '/images/',  $name);

            $user_image_name = '/images/' . $name;

            $data['image'] = $user_image_name;
        }

        $user = null;
        DB::transaction(function () use (&$user, $request, $user_image_name) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'title' => $request->title,
                'image' => $user_image_name,
                'password' => bcrypt($request->password),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);

            $role = Role::where('id', $request->role)->first();

            $rolePermissions = $role->permissions;

            $user->assignRole([$role]);
            $user->syncPermissions($rolePermissions);
        });
        return response([
            'user' => new UserResource($user),
            'message' => 'User Added Successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Response
    {
        return response([
            'user' => new UserResource($user->permissions),
        ], 202);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): Response
    {

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

        DB::transaction(function () use (&$user, $request, $data) {

            $user->update($data);

            $role = Role::where('id', $request->role)->first();
            // sync new roles
            $user->syncRoles([$role]);
            // sync new permissions via sent role
            $user->syncPermissions($role->permissions);
        });

        return response([
            'user' => new UserResource($user),
            'message' => 'User Updated successfully!'
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): Response
    {

        $permissions = $user->getAllPermissions();
        $user->revokePermissionTo($permissions);
        $user->delete();

        return response([
            'message' => 'User Deleted successfully!'
        ], 200);
    }

    public function addPermissions(Request $request, User $user)
    {
        $request->validate([
            'roles' => ['array'],
        ]);

        $permissions = $user->getAllPermissions();

        $new_permissions = array_unique(array_merge($permissions->pluck('id')->toArray(), $request->roles));

        $user->syncPermissions($new_permissions);

        return response()->json(['message' => 'permissions granted successfully'], 202);
    }

    public function getUserPermissions(Request $request, User $user)
    {

        $permissions = $user->getAllPermissions();

        return response()->json(['user_permissions' => $permissions], 200);
    }

    public function syncPermissions(Request $request, User $user)
    {
        $request->validate([
            'roles' => ['array'],
            'roles.id' => ["integer"]
        ]);

        $new_permissions =  collect($request->roles)->pluck('id');

        $user->syncPermissions($new_permissions);

        return response()->json(['message' => 'permissions synced successfully'], 202);
    }
}
