<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
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

    public function register(Request $request){

        $validator = Validator::make($request->all(),[

            'num_boleta' => 'required|min:10|unique:students,num_boleta',
            'name' => 'required',
            'first_name' => 'required',
            'second_name' => 'required',
            'email' => 'required|email|unique:students,email',
            'career_id'=> 'required',
            'password' => 'required|min:5|max:30',
        ]);

        if ($validator->fails()) {
            
            return response()->json([
                'success' => 'false',
                'message' => 'Ocurrio un error en el registro.'
            ]);
        }

        Student::create([

            'num_boleta' => $request->get('num_boleta'),
            'name' => $request->get('name'),
            'first_name' => $request->get('first_name'),
            'second_name' => $request->get('second_name'),
            'email' => $request->get('email'),
            'career_id' => $request->get('career_id'),
            'password' => bcrypt($request->get('password'))
        ]);

        return response()->json([
            'success' => 'true',
            'message' => 'Se ha registrado con éxito'
        ]);

        
    }
}
