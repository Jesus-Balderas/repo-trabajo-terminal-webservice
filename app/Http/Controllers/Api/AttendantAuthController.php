<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendantAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('num_empleado', 'password');
        
        if (Auth::guard('api-attendant')->attempt($credentials)) {

            $attendant = Auth::guard('api-attendant')->user();
            $token = Auth::guard('api-attendant')->attempt($credentials);
            $success = true;
            
            return compact('success', 'attendant', 'token');

        } else {

            $success = false;
            $message = 'Credenciales incorrectas';
            return compact('success', 'message');
        }

    }

    public function show(){

        $attendant = Auth::guard('api-attendant')->user();
        $laboratory = Auth::guard('api-attendant')->user()->laboratories;
        return compact('attendant');
    }

    public function logout(){

        Auth::guard('api-attendant')->logout();
        $success = true;
        $message = 'Cierre de sesión exitoso';
        return compact('success', 'message');
    }
}
