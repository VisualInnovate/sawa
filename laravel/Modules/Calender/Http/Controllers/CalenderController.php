<?php

namespace Modules\Calender\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerHandler;
use App\Models\ChildParent;
use App\Models\User;
use App\Notifications\AcceptBookingNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Calender\Entities\Booking;
use Modules\Calender\Entities\Calender;
use Modules\Calender\Http\Controllers\Repository\CalenderRepository;
use Modules\Calender\Http\Controllers\Services\CalenderService;
use Modules\Calender\Http\Requests\CalenderRequest;
use Modules\Calender\Http\Requests\StoreBookingRequest;
use Modules\Calender\Http\Requests\UpdateBookingRequest;
use Modules\Calender\Transformers\EventResource;
use Modules\Child\Entities\Child;
use Modules\Child\Http\Controllers\Services\ChildService;

class CalenderController extends Controller
{
    private $ControllerHandler;
    private $bookingControllerHandler;
    public function __construct()
    {

        $this->ControllerHandler = new ControllerHandler(new Calender());

        $this->bookingControllerHandler = new ControllerHandler(new Booking());
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        //        return $this->ControllerHandler->getAll("calender");
        return response(['calender' => EventResource::collection(Calender::currentAuth()->get())]);
    }

    public function groupedEventsForParents()
    {
        return $this->ControllerHandler->show("events", CalenderService::groupEventsOnTheSameDay(CalenderRepository::getEventsOnDayForParents()));
    }

    public function storeBookingForChild(StoreBookingRequest $request)
    {

        return $this->bookingControllerHandler->store("booking", $request->validated());
    }

    ////////////////////////////////
    public function getAllBooking(Request $request)
    {
        $bookings = Booking::query()
            ->select(
                'id',
                'requester_phone'
            )
            ->addSelect([
                'event_date' => Calender::select('start')->whereColumn('id', 'bookings.event_id'),
                'child_name' => Child::select('name')->whereColumn('id', 'bookings.child_id'),
                'child_age' => Child::select('birth_date')->whereColumn('id', 'bookings.child_id'),
            ])
            ->latest()
            ->get();

        $bookings->map(function ($booking) {
            $booking['child_age'] = (new ChildService())->calcChildAgeInMonthsWithAgeParam($booking['child_age']);
        });


        return $this->bookingControllerHandler->show('bookings', $bookings);
    }

    public function getAllAcceptedBookingDoctors(Request $request)
    {
        $data = [];

        $data = DB::table('bookings')
            ->select(
                "bookings.id as booking_id",
                "bookings.user_id",
                "event_id",
                "accepted",
                "start as event_date",
                'users.name as user_name',
                'users.title as user_title',
                'users.image as user_image'
            )
            ->join('events', 'events.id', '=', 'bookings.event_id')
            ->join('users', 'users.id', '=', 'events.user_id')
            ->where('bookings.user_id', $this->getAuthUserID('parent'))
            ->get();

        $data->map(function ($item) {
            $item->user_image = url($item->user_image);
        });


        return $this->bookingControllerHandler->show('bookings', $data);
    }

    public function showBooking($booking_id, Request $request)
    {

        $data['booking'] = Booking::query()
            ->select("*")
            ->addSelect([
                "event_date" => Calender::select('start')->whereColumn('id', 'bookings.event_id'),
                "child_name" => Child::select('name')->whereColumn('id', 'bookings.child_id'),
                "child_birth_place" => Child::select('birth_place')->whereColumn('id', 'bookings.child_id'),
                "child_birth_date" => Child::select('birth_date')->whereColumn('id', 'bookings.child_id'),
                "child_lang" => Child::select('lang')->whereColumn('id', 'bookings.child_id'),
                "child_gender" => Child::select('gender')->whereColumn('id', 'bookings.child_id'),
                "child_nationalty" => Child::select('nationalty')->whereColumn('id', 'bookings.child_id'),
                "child_national_id" => Child::select('national_id')->whereColumn('id', 'bookings.child_id'),
                "child_address" => Child::select('address')->whereColumn('id', 'bookings.child_id'),

            ])
            ->where('id', $booking_id)
            ->first();

        // if ($data['booking']['doctor_code']) {
        //     $data['doctor'] = DB::table("users")
        //         ->select('users.name', 'users.title')
        //         ->where("id", '=', $data['booking']['doctor_code'])
        //         ->first();
        // }

        $data['doctor'] = DB::table("users")
            ->select('users.name', 'users.title', 'users.image', 'events.id as event_id')
            ->leftJoin("events", "events.user_id", '=', 'users.id')
            ->where('events.id', '=', $data['booking']['event_id'])
            ->first();

        $data = collect($data);

        $data->map(function ($doctor) {
            $doctor->image = url($doctor->image);
        });


        return $this->bookingControllerHandler->show('booking', $data);
    }

    public function updateBooking($booking_id, UpdateBookingRequest $request)
    {
        $booking = Booking::where('id', $booking_id)->first();

        $booking->update($request->validated());

        return $this->bookingControllerHandler->show('booking', $booking);
    }

    public function changeDoctor(Request $request)
    {
        $request->validate([
            'start' => ['required']
        ]);

        $doctors = Calender::query()
            ->select('user_id', 'start', 'events.id as event_id')
            ->addSelect([
                'name' => User::select("name")->whereColumn('id', 'user_id'),
                'title' => User::select("title")->whereColumn('id', 'user_id'),
                'image' => User::select("image")->whereColumn('id', 'user_id'),
            ])
            ->where('start', $request->start)
            ->get();

        $doctors->map(function ($doctor) {
            $doctor->image = url($doctor->image);
        });

        return $this->bookingControllerHandler->show('doctors', $doctors);
    }

    public function acceptBooking(Booking $booking, Request $request)
    {
        $request->validate([
            'status' => ['required', 'in:0,1,2'],
            'event_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'accepted_notes' => ['nullable', 'string'],
            'doctor_name' => ['required', 'string'],
            'doctor_title' => ['required', 'string'],
            'booking_result' => ['nullable', 'string']
        ]);

        $booking->update([
            'accepted' => $request->status,
            'event_id' => $request->event_id,
            'accepted_notes' => $request->accepted_notes,
            "booking_result" => $request->booking_result ?? null
        ]);

        $event = Calender::where('id', $request->event_id)->first();

        $doctor = [
            "doctor_name" => $request->doctor_name,
            "doctor_title" => $request->doctor_title
        ];
        $user = ChildParent::where('id', $request->user_id)->first();

        $user->notify(new AcceptBookingNotification($event, $booking, $doctor));

        if ($request->status == 1) {
            $event->update([
                'status' => 1
            ]);
        }

        return $this->bookingControllerHandler->show('booking', $booking->fresh());
    }

    public function getLatestReportForChild(Request $request)
    {
        $request->validate([
            'child_id' => ['required', 'integer']
        ]);

        $child_id = $request->child_id;
        $parent_id = auth('parent')->id();

        $report = Booking::query()
            ->select('booking_result', DB::raw("updated_at as report_date"))
            ->where('user_id', $parent_id)
            ->where('child_id', $child_id)
            ->latest()
            ->first();

        return $this->bookingControllerHandler->show('report', $report);
    }

    /////////////////////////////////

    public function show(Calender $calender)
    {
        return $this->ControllerHandler->show("calender", $calender);
    }

    /**
     * @param CalenderRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(CalenderRequest $request)
    {

        $data = [];

        $start_date = Carbon::parse($request->start)->format("Y-m-d");
        $end_date = Carbon::parse($request->end)->subDay()->format("Y-m-d");

        // $events = Calender::query()
        //     ->where('status', 0)
        //     ->where('user_id', auth('api')->id())

        //     ->whereDate('start', "=", $start_date)
        //     ->whereDate('end', "=", $end_date)

        //     ->where(function ($q) use ($request) {
        //         $q->where(DB::raw("TIME(start)"), ">=", $request->time_start)
        //             ->where(DB::raw("TIME(end)"), "<=", $request->time_end);
        //     })
        //     ->orWhere(function ($q) use ($request) {
        //         $q->where(DB::raw("TIME(start)"), "<=", $request->time_start)
        //             ->where(DB::raw("TIME(end)"), ">=", $request->time_end);
        //     })
        //     ->orderBy('start')
        //     ->get();


        // $events = Calender::query()
        //     ->where('status', 0)
        //     ->where('user_id', auth('api')->id())
        //     ->whereDate('start', '=', $start_date)
        //     ->whereDate('end', '=', $end_date)

        //     ->where(function ($q) use ($request) {
        //         $q->where(function ($q) use ($request) {
        //             $q->whereTime('start', '>=', $request->time_start)
        //                 ->whereTime('end', '<=', $request->time_end);
        //         })
        //      ->orWhere(function ($q) use ($request) {
        //                 $q->whereTime('start', '<=', $request->time_start)
        //                     ->whereTime('end', '>=', $request->time_end);
        //      });
        //     })
        //     ->orderBy('start')
        //     ->get();



        $events = Calender::query()
            ->where('status', 0)
            ->where('user_id', auth('api')->id())
            ->whereDate('start', '=', $start_date)
            ->whereDate('end', '=', $end_date)

            ->where(function ($q) use ($request) {
                $q->where(function ($q) use ($request) {
                    $q->whereTime('start', '>=', $request->time_start)
                        ->whereTime('end', '<=', $request->time_end);
                })
                    ->orWhere(function ($q) use ($request) {
                        $q->whereTime('start', '<=', $request->time_start)
                            ->whereTime('end', '>=', $request->time_end);
                    });
            })
            ->orderBy('start')
            ->get();






        // return $events;

        if (count($events)) {
            return response()->json(['message' => "duplicate event"], 442);
        }

        $start_date_time = "$start_date $request->time_start";
        $end_date_time = "$end_date $request->time_end";

        $data['title'] = $request->user()->name;
        $data['start'] = Carbon::createFromFormat("Y-m-d H:i", $start_date_time);
        $data['end'] = Carbon::createFromFormat("Y-m-d H:i", $end_date_time);
        $data['user_id'] = $request->user()->id;

        return $this->ControllerHandler->store("calender", $data);
    }


    public function update(CalenderRequest $request, Calender $calender)
    {
        // here some validation check parent or admin
        return $this->ControllerHandler->update("calender", $calender, $request->validated());
    }


    public function destroy(Calender $calender)
    {
        // here some validation check parent or admin

        return $this->ControllerHandler->destory("calender", $calender);
    }
}
