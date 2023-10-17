<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:roles.index|roles.create|roles.show|roles.edit|roles-delete', ['only' => ['index','store']]);
        $this->middleware('permission:roles.create', ['only' => ['store']]);
        $this->middleware('permission:roles.show', ['only' => ['show']]);
        $this->middleware('permission:roles.edit', ['only' => ['update']]);
        $this->middleware('permission:roles.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $roles = Role::where('name', 'LIKE' , '%'.$request->name.'%')->with('permissions')->orderBy('id','DESC')->paginate($request->size);

        return response([
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permissions'));

        return response([
            'role' => $role,
            'message' => 'Role Added Successfully!'
        ], 201);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Role $role)
    {
        $rolePermissions = $role->permissions;

        return response([
            'role' => $role,
            'permissions' => $rolePermissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
        ]);
        
        $role->update($request->only('name'));
    
        $role->syncPermissions($request->get('permissions'));

        return response([
            'role' => $role,
            'message' => 'Role Updated successfully!'
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return response([
            'message' => 'Role Deleted successfully!'
        ], 200);

    }
}
