<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Role;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Employer;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function showAdminDash(){
        return view('admin.dashboard');
    }

    public function showUsers(){
        $users = User::paginate(5);
        return view('admin.user.users', ['users'=>$users]);
    }

    public function showEditForm($id) {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request, $id) {

            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role_id = $request->input('role');
            $user->save();

            if ($user->role->name == 'employer') {
                $trainingId = $request->input('training');

                if ($trainingId && $trainingId !== 'Select Training') {
                    if ($user->role->name == 'employer') {
                        $employer = $user->employer->first();
                        if (!$employer) {
                            $employer = new Employer();
                            $employer->user_id = $user->id;
                            $employer->save();
                        }

                        if (!$employer->trainings()->where('training_id', $trainingId)->exists()) {
                            $employer->trainings()->attach($trainingId);
                        }
                    }
                }
            }

            return redirect()->route('users.table')->with('message', "The user is updated successfully!");
        }


    public function deleteUser($id){

        $user = User::findOrFail($id);


        $user->delete();

        return redirect()->route('users.table')->with('message' , "The user is removed succesfully!");
    }

    public function showRoles(){
        $roles = Role::paginate(5);

        return view('admin.role.roles', compact('roles'));
    }

    public function showRolesForm(){

        return view('admin.role.form');
    }


    public function createRole(Request $request)
    {
        $roleData = $request->validate([
            'name' => 'required'
        ]);

        Role::create($roleData);

        return redirect()->route('roles.table')->with('message', "The role is created successfully!");
    }

    public function showRolesEditForm($id){
        $role = Role::findOrFail($id);
        $roles = Role::all();

        return view('admin.role.edit', compact('role', 'roles'));
    }


    public function updateRole(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->update([
            'name' => $request->input('name'),
            'id' => $request->input('id'),
        ]);

        return redirect()->route('roles.table')->with('message', "The role is updated successfully!");
    }

    public function deleteRole($id){

        $role = Role::findOrFail($id);


        $role->delete();

        return redirect()->route('roles.table')->with('message' , "The role is removed succesfully!");
    }


    public function showPages(){
        return view('admin.pages');
    }

    public function showGradesForm(){
        return view('admin.gradesForm');
    }

    public function showUploadForm(){
        return view('admin.upload');
    }

}
