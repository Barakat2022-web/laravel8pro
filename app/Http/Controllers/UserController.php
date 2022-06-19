<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //access the request method
        //return $request->method();

        //return $request->path();

        return $request->fullUrl();
    }

    public function getLoginForm()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $validatedData=$request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6|max:12'
        ]);
        $email=$request->input('email');
        $password=$request->input('password');
        return 'Email:-'.$email.'Password:-'.$password;
    }

    //Use Pagination in this method
    public function allUsers()
    {

        $users=User::paginate(20);

        return view('contact',compact('users'));
    }

    public function getUploadPage()
    {

        return view('about');
    }

    public function uploadFile(Request $request)
    {

         //default value of file path
         $file_path="";

         if($request->has('file'))
         {
             $filename=$request->file('file')->getClientOriginalName();
            $request->file->move('image',$filename);
         }

        return "File  upload";
    }

    //Add record to user table with phone Relation
    public function insertRecord()
    {
        #Add Phone to Table Phne
        $phone=new Phone();
        $phone->phone="0795745814";

        #Add use to table users
        $user=new User();
         $user->name="barakat";
         $user->email="barakatalrashdan@gmail.com";

        $user->password=encrypt('admin');

        $user->save();
        $user->phone()->save($phone);


        return 'record has been created successfully';

    }

    public function fetchPhoneByUser($id)
    {
        return $phone=User::find($id)->phone_user;
    }
}
