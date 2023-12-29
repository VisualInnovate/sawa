<?php

namespace Modules\Room\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Modules\Room\Entities\Room;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
      $parents = Room::select('id', 'title')->get();

        return response()->json([
            'parents' => $parents,
        ]);
    
    }

   

   
    public function store(Request $request)
    {
        return response()->json([
            'stutes'=>'success',
            'code'=>200,
            'rooms'=>$request->all(),
           ],200);
      $rooms = Room::create($request->all());
       return response()->json([
        'stutes'=>'success',
        'code'=>200,
        'rooms'=>$rooms
       ],200);
    }

    
    public function show($id)
    {
        $data =Room::find(1);
        return response()->json($data->users);
    }

   

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
