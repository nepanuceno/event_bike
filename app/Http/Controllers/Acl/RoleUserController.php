<?php

namespace App\Http\Controllers\Acl;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Throwable;

class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('role_user.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = User::find($request->user);
            $user->assignRole([$request->roles]);

            return back()->with('success', __('roles_user.link_successfully_completed').'!');
        } catch (Throwable $e) {
            report($e);
            return back()->with('error', __('roles_user.error').': '.$e);
            // return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id and $role
     * @return \Illuminate\Http\Response
     */
    public function delete_roles_user($user_id, $role)
    {
        $user = User::find($user_id);
        if($user->hasRole($role)) {

            try {
                $user->removeRole($role);
                return redirect()->back()->with('success', __('roles_user.function') ." [".$role."] ". __('roles_user.unlinked_from') ." ".$user->name);
            } catch (\Throwable $th) {

                return redirect()->back()->with('error', __('roles_user.function') ."[".$role."] ".__('roles_user.could_unlinked_from')." ".$user->name);
                //throw $th;
            }
        }
    }

    /**
     * Roles for User the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roles_user($id)
    {
        $user = User::find($id);
        $roles = $user->getRoleNames();

        return json_encode($roles);
    }
}
