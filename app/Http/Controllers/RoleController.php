<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function addRole()
    {
        $roles=[
            ["name"=>"Administrator"],
            ["name"=>"Editor"],
            ["name"=>"Author"],
            ["name"=>"Contributor"],
            ["name"=>"Subscribers"]

        ];

       
    Role::insert($roles);
        return "Role are created successfully";
    }

    public function addUser()
    {
         $user=new User();
  
         $user->name="ahmad";
        $user->email="ahmad.kamal@ymail.com";
        $user->password=encrypt('secret');
 
        $user->save(); 

         $roleids=[20,19,18];

        $user->roles()->attach($roleids);

        return "Record has been created successfully";
    }

    public function getAllRolesByUser($id)
    {
        $user=User::find($id);
        return $user->roles->makeHidden(['profile_photo_url','profile_photo_path','current_team_id','two_factor_confirmed_at','email_verified_at','created_at','updated_at']);
    }

    public function getAllUsersByRole($id)
    {
        $role=Role::find($id);

        return $role->users->makeHidden(['profile_photo_url','profile_photo_path','current_team_id','two_factor_confirmed_at','email_verified_at','created_at','updated_at']);
    }
}
