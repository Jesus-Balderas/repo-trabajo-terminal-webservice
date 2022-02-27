<?php

namespace App\Http\Controllers;

use App\Models\Attendant;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendantController extends Controller
{
    
    public function index()
    {
        $attendants = Attendant::all();
        return view('attendants.index', compact('attendants'));

    }

    public function create()
    {
        $laboratories = Laboratory::all();
        return view('attendants.create', compact('laboratories'));
    }

    public function check(Request $request)
    {
        $rules = [
            'num_empleado'=> 'required|exists:attendants,num_empleado',
            'password' => 'required|min:5|max:30'
        ];

        $messages = [

            'num_empleado.exists' => 'El número de empleado no se encuentra registrado.'
        ];

        $this->validate($request, $rules, $messages);

        $credentials = $request->only('num_empleado', 'password');

        if (Auth::guard('attendant')->attempt($credentials)) {
            
            return redirect()->route('attendant.home');

        } else {
            return redirect()->back()->with('fail', 'Credenciales incorrectas, intente de nuevo');
        }

    }

    public function logout()
    {
        Auth::guard('attendant')->logout();
        return redirect()->route('attendant.login');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [

            'num_empleado' => 'required|min:3|unique:attendants,num_empleado',
            'name' => 'required|min:5',
            'first_name' => 'required|min:5',
            'second_name' => 'required|min:5',
            'email' => 'required|email|unique:attendants,email',
            'laboratories'=> 'required',
            'password' => 'required|min:5|max:30',
        ];

        $messages = [

            'num_empleado.unique' => 'El numero de empleado ingresado ya fue registado.',
            'email.unique' =>  'El correo electronico ingresado ya se fue registrado.'
        ];

        $this->validate($request, $rules, $messages);

        $attendant = new Attendant();
        $attendant->num_empleado = $request->input('num_empleado');
        $attendant->name = $request->input('name');
        $attendant->first_name = $request->input('first_name');
        $attendant->second_name = $request->input('second_name');
        $attendant->email = $request->input('email');
        $attendant->laboratory()->associate($request->input('laboratories'));
        $attendant->password = bcrypt($request->input('password'));
        $attendant->save();

        $notification = "El encargado se ha registrado correctamente.";

        return redirect('/attendants')->with(compact('notification'));
    }

    public function edit($id)
    {
        
        $attendant = Attendant::findOrFail($id);
        $laboratories = Laboratory::all();
        $laboratory_ids = $attendant->laboratory()->pluck('id');
        //dd($attendant, $laboratories, $laboratory_ids);
        return view('attendants.edit', compact('attendant', 'laboratories', 'laboratory_ids'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'num_empleado' => 'required|min:3',
            'name' => 'required|min:5',
            'first_name' => 'required|min:5',
            'second_name' => 'required|min:5',
            'email' => 'required|email'
        ];

        $this->validate($request, $rules);

        $attendant = Attendant::findOrFail($id);
        $data = $request->only('num_empleado', 'name', 'first_name', 'second_name', 'email');
        $password = $request->input('password');
        if ($password) {
            $data['password'] = bcrypt($password);
        }
        $laboratory = $request->input('laboratories');
        if ($laboratory) {
            $data['laboratory'] = $attendant->laboratory()->associate($laboratory);
        }
        $attendant->fill($data);
        $attendant->save();
        
        $notification = "La información del encargado se ha actualizado correctamente.";
        return redirect('/attendants')->with(compact('notification'));
    }

    public function destroy(Attendant $attendant)
    {
        $attendantName = $attendant->name;
        $attendant->delete();
        $notification = "El médico $attendantName se ha eliminado correctamente.";
        return redirect('/attendants')->with(compact('notification'));

    }
}
