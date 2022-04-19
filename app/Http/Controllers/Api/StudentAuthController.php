<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('num_boleta', 'password');
        
        if (Auth::guard('api-student')->attempt($credentials)) {

            $student = Auth::guard('api-student')->user();
            $career = Auth::guard('api-student')->user()->career;
            $token = Auth::guard('api-student')->attempt($credentials);
            $success = true;
            
            return compact('success', 'student', 'token');

        } else {

            $success = false;
            $message = 'Credenciales incorrectas';
            return compact('success', 'message');
        }

    }

    public function show(){

        $student = Auth::guard('api-student')->user();
        $career = Auth::guard('api-student')->user()->career;
        return compact('student');
    }

    public function logout(){

        Auth::guard('api-student')->logout();
        $success = true;
        $message = 'Cierre de sesion exitoso';
        return compact('success', 'message');
    }
}
