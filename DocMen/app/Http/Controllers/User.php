<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    public function showRegistrationForm(){
        return view('constructions.registration');
        //return $request->all();
    }

    public function processRegistration(Request $request)
    {        
        //return $request->all();
        //dd($$request->all());
        $this->validate($request,[
            'fname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required|min:6',
        ]);
            //echo "Ok Bhai";
        $data = [
            'fname' => $request->input('fname'),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
            'phone' => $request->input('phone'),
        ];
            
        try{
            user::creat($data);
            return redirect()->route('constructions/login');
        }catch(Exception $e){
            return redirect()->back();
        }
        
    }
}
