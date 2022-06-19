<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeContoller extends Controller
{
    public function index($name=null)
    {
        return 'Hi From WelcomeController.<br>My name is'.$name;
    }

    public function fruits()
    {
        $fruites=array('Mango','Organge','Banana','Apple','Pineapple');
        return view('welcome',compact('fruites'));
    }

    //Access the Session Data
    public function getSessionData(Request $request)
    {
        if($request->session()->has('name'))
        {
            echo $request->session()->get('name');
        }
        else
        {
            echo 'No Data in the session';
        }
    }

    public function storeSessionData(Request $request)
    {
        $request->session()->put('name','Barakat');

        echo "data has been added to the sesssion";
    }

    Public function deleteSessionData(Request $request)
    {
         $request->session()->forget('name');
         echo "data has been deleted to the sesssion";
    }
}
