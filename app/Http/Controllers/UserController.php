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
        $db_connect = true;
        try {
            \DB::connection()->getPDO();
            \DB::connection()->getDatabaseName();
            } catch (\Exception $e) {
                $db_connect = false;
                return \response('DB connection failed', 500)
                ->header('Content-Type', 'text/plain');
        }
        if($db_connect){
            if (Auth::guard('api')->attempt($credentials)) {
                $employee_list = file_get_contents("sample.json");
                $employees = json_decode(json_encode($employee_list) );
                return \response($employees,200)->header('Content-Type', 'text/json');
        
            }
            else{
                return \response('Wrong Credentials. login failed',401);
            }
        }
    }
}
