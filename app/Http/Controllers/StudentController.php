<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function register()
    {
        $careers = Career::all();
        return view('dashboard.student.register', compact('careers'));
    }

    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create(Request $request)
    {
        //dd($request);
        $rules = [

            'num_boleta' => 'required|min:10|unique:students,num_boleta',
            'name' => 'required|min:5',
            'first_name' => 'required|min:5',
            'second_name' => 'required|min:5',
            'email' => 'required|email|unique:students,email',
            'careers'=> 'required',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password'
        ];

        $this->validate($request, $rules);

        $student = new Student();
        $student->num_boleta = $request->input('num_boleta');
        $student->name = $request->input('name');
        $student->first_name = $request->input('first_name');
        $student->second_name = $request->input('second_name');
        $student->email = $request->input('email');
        $student->password = bcrypt($request->input('password'));
        $student->career()->associate($request->input('careers'));
        
        $save = $student->save();

        if ($save) {
            
            return redirect()->back()->with('success', '¡Se ha registrado existosamente!');

        } else {

            return redirect()->back()->with('fail', 'Algo salió mal, falló el registro');
        }
    }

    public function check(Request $request)
    {
        $rules = [
            'num_boleta'=> 'required|exists:students,num_boleta',
            'password' => 'required|min:5|max:30'
        ];

        $messages = [

            'num_boleta.exists' => 'El número de boleta no se encuentra registrado.'
        ];

        $this->validate($request, $rules, $messages);

        $credentials = $request->only('num_boleta', 'password');
        if (Auth::guard('student')->attempt($credentials)) {
            
            return redirect()->route('student.home');

        } else {
            return redirect()->back()->with('fail', 'Credenciales incorrectas, intente de nuevo');
        }

    }

    public function logout(){

        Auth::guard('student')->logout();
        return redirect()->route('student.login');
    }
}
