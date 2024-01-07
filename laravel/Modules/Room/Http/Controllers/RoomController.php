<?php

namespace Modules\Room\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Modules\Room\Entities\Room;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Treatment\Entities\AppointmentType;
use Modules\Treatment\Entities\ProgramSystem;
use Modules\Treatment\Entities\ProgramType;
use Modules\Treatment\Entities\SessionType;
use Modules\Treatment\Entities\TreatmentType;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $rooms =Room::with('user', 'treatmentType')->get();

        return response()->json([
            'rooms' => $rooms,
        ]);
    }
    public function getDortor()
    {
        $doctor = User::where('status', 2)->get();
        return response()->json([
            'doctors' => $doctor,
        ]);
    }

    public function store(Request $request)
    {


        $rooms = Room::create($request->all());
        return response()->json([
            'stutes' => 'success',
            'code' => 200,
            'rooms' => $rooms
        ], 200);
    }


    public function show($id)
    {
        $rooms = Room::with('user', 'treatmentType')->find($id);
        return response()->json([
            'rooms' => $rooms,
        ]);
    }

    public function allInputData()
    {
        $appionment = AppointmentType::get();
        $programtype = ProgramType::get();
        $session = SessionType::get();
        $treatmenttype = TreatmentType::get();
        $programsystemt = ProgramSystem::get();
        return response()->json([
            'programtype' => $programtype,
            'appionment' => $appionment,
            'session' => $session,
            'treatmenttype' => $treatmenttype,
            'programsystemt' => $programsystemt,
        ]);
    }

    public function update(Request $request, $id)
    {
        $rooms = Room::find($id);

        $rooms->update($request->all());
        return response()->json($rooms);
    }

    public function destroy($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['message' => 'room not found'], 404);
        }

        $room->delete();

        return response()->json(['message' => 'room deleted successfully']);
    }
 
}
