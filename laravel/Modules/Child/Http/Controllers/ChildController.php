<?php

namespace Modules\Child\Http\Controllers;

use App\Http\Controllers\ControllerHandler;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Calender\Entities\Booking;
use Modules\Child\Entities\Child;
use Modules\Child\Http\Controllers\Repository\ChildRepository;
use Modules\Child\Http\Controllers\Services\ChildService;
use Modules\Child\Http\Requests\ChildRequest;
use Modules\Child\Transformers\AllChildResource;
use Modules\Child\Transformers\ChildResource;
use Modules\Evaluation\Entities\Evaluation;

class ChildController extends Controller
{


    private $ControllerHandler;

    public function __construct()
    {
        $this->middleware('permission:child.index|child.create|child.show|child.update|child.delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:child.create', ['only' => ['store']]);
        $this->middleware('permission:child.show', ['only' => ['show']]);
        $this->middleware('permission:child.update', ['only' => ['update']]);
        $this->middleware('permission:child.delete', ['only' => ['destroy']]);
        $this->middleware('permission:child.childAndEvaluation', ['only' => ['childAndEvaluation']]);
        $this->middleware('permission:child.getChildAndSideProfile', ['only' => ['getChildAndSideProfile']]);

        $this->ControllerHandler = new ControllerHandler(new Child());
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        return $this->ControllerHandler->getAll("children");
    }

    public function getParentChilds(Request $request)
    {
        $parent_id = auth('parent')->id();

        $childs = Child::query()
            ->select("id", "name", "birth_date")
            ->addSelect([
                "report_text" => Booking::select("booking_result")->whereColumn("bookings.child_id", "children.id")->latest()->take(1),
                "report_date" => Booking::select("updated_at")->whereColumn("bookings.child_id", "children.id")->latest()->take(1),
            ])
            ->where('parent_id', $parent_id)
            ->get();


        // $childs = DB::table("children")
        //     ->select(
        //         "children.id",
        //         "children.name",
        //         "children.birth_date",
        //         "bookings.booking_result as report_text",
        //         "bookings.updated_at as report_date"
        //     )
        //     ->join("bookings", "children.id", "=", "bookings.child_id")
        //     ->where("user_id", $parent_id)
        //     ->latest("bookings.created_at")
        //     ->get();

        return $this->ControllerHandler->show('childs', AllChildResource::collection($childs));
    }

    /**
     * @param Child $child
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show(Child $child)
    {

        $child->childInMonths = (new ChildService)->calcChildAgeInMonths($child);

        return $this->ControllerHandler->show("child", $child);
    }

    /**
     * @param ChildRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(ChildRequest $request)
    {
        $data = $request->validated();
        return $this->ControllerHandler->store("children", $data);
    }

    /**
     * @param ChildRequest $request
     * @param Child $child
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */

    public function update(ChildRequest $request, Child $child)
    {

        // here some validation check parent or admin


        return $this->ControllerHandler->update("child", $child, $request->validated());
    }


    public function destroy(Child $child)
    {
        // here some validation check parent or admin


        return $this->ControllerHandler->destory("children", $child);
    }


    public function childAndEvaluation(Child $child, Evaluation $evaluation)
    {

        return $this->ControllerHandler->show("child", (new ChildService)->getChildWithAgeInMonthAndCheckIfCanDoExam($child, $evaluation));
    }

    public function getChildAndSideProfile(Child $child)
    {
        return $this->ControllerHandler->show('sideProfile', (new ChildService)->getChildWithSideProfile($child));
    }


    public function getResultsWithSideprofile(Request $request)
    {
        return $this->ControllerHandler->show('evaluation_results', ChildRepository::getResultsWithSideProfile($request));
    }
}
