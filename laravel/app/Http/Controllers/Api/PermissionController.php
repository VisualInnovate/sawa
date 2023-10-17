<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:permissions.index|permissions.create|permissions.show|permissions.edit|roles-delete', ['only' => ['index','store']]);
        $this->middleware('permission:permissions.create', ['only' => ['store']]);
        $this->middleware('permission:permissions.show', ['only' => ['show']]);
        $this->middleware('permission:permissions.edit', ['only' => ['update']]);
        $this->middleware('permission:permissions.delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        // $permissions = Permission::paginate($request->all());
        $permissions = Permission::where('name', 'LIKE' , '%'.$request->name.'%')->orderBy('id','DESC')->paginate($request->size);
        return response([
            'permissions' => $permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        $permission = Permission::create($request->only('name'));

        return response([
            'permission' => $permission,
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Permission $permission)
    {
        return response([
            'permission' => $permission,
            'message' => 'Permission Added Successfully!'
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id
        ]);

        $permission->update($request->only('name'));
        return response([
            'permission' => $permission,
            'message' => 'Permission Updated successfully!'
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->noContent();
    }
}
