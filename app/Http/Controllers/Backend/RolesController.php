<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\CustomFunction;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr as TostrMsg;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $roles = Role::all();
        return view( 'Backend/pages/roles/index', compact( 'roles' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $permissions = Permission::all()->groupBy( 'group_name' );
        return view( 'Backend/pages/roles/create', compact( 'permissions' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $req ) {
        //validation data
        $validatedData = $req->validate(
            [
                'name'       => 'required|max:100|unique:roles',
                'permission' => 'required',

            ],
            // error msg add manually
            [
                'name.required'       => 'Please insert a role name',
                'name.unique'         => 'This role name already taken',
                'name.max'            => 'This role name should be maximum 100 characters',
                'permission.required' => 'Please select a permission',
            ] );

        //variable get data
        $roleName    = $req->name;
        $permissions = $req->permission;

        //save data to database using spatie default command
        $saveRole = Role::create( ['name' => $req->name] );
        //check permission existence
        if ( !empty( $permissions ) ) {
            //save role based permission in database through spatie default command
            $saveRole->syncPermissions( $permissions );
            return back();
        } else {
            return false;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        $role        = Role::findById( $id );
        $permissions = Permission::all()->groupBy( 'group_name' );

        // $permission_groups = User::getpermissionGroups();
        return view( 'Backend/pages/roles/edit', compact( 'role', 'permissions' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $req, $id ) {
        //validation data
        $validatedData = $req->validate(
            [
                'name'       => 'required|max:100|unique:roles,name,' . $id,

                'permission' => 'required',

            ],
            // error msg add manually
            [
                'name.required'       => 'Please insert a role name',
                'name.unique'         => 'This role name already taken',
                'name.max'            => 'This role name should be maximum 100 characters',
                'permission.required' => 'Please select a permission',
            ] );

        //variable get data
        $roleName    = $req->name;
        $permissions = $req->permission;

        //save data to database using spatie default command
        $role = Role::findOrFail( $id );
        //check permission existence
        if ( !empty( $permissions ) ) {
            $role->name = $roleName;
            $role->save();
            //save role based permission in database through spatie default command
            $role->syncPermissions( $permissions );

            $title = "Roles Updated!";
            $msg   = Str::title( "The role <strong>($role->name)</strong> is Updated" );
            TostrMsg::success( $msg, $title, CustomFunction::ToastSettings() );
            return redirect()->back();
        } else {
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {

        $role = Role::findById( $id );
        if ( !is_null( $role ) ) {
            $role->delete();

        }
        $title = "Role Deleted!";
        $msg   = Str::title( "The role <strong>($role->name)</strong> is Deleted" );
        TostrMsg::success( $msg, $title, CustomFunction::ToastSettings() );
        return redirect()->back();

    }
}
