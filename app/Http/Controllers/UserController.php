<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function getEmployees(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('web')->attempt($credentials)) {

            $employee_list = file_get_contents("sample.json");
            $employees = json_decode(json_encode($employee_list) );
            return $employees;
    
        }
        else{
            return 'login failed';
        }
    }
}
