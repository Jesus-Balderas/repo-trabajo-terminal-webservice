<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(Request $request){

        $rules = [
            'name' => 'required',
            'email'=> 'required|email|unique:users,email',
            'password' => 'required|min:5|max:30',
            'cpassword'=> 'required|min:5|max:30|same:password'
        ];

        $this->validate($request, $rules);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $save = $user->save();

        if( $save ){
            return redirect()->back()->with('success', '¡Se ha registrado existosamente!');
        }
        else{
            return redirect()->back()->with('fail', 'Algo salió mal, falló el registro');
        }

    }

    public function check(Request $request){
        
        $rules = [
            'email'=> 'required|email|exists:users,email',
            'password' => 'required|min:5|max:30'
        ];

        $messages = [

            'email.exists' => 'El correo electronico no se encuentra registrado.'
        ];

        $this->validate($request, $rules, $messages);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            
            return redirect()->route('user.home');

        } else {
            return redirect()->back()->with('fail', 'Credenciales incorrectas, intente de nuevo');
        }

    }

    public function logout(){

        Auth::guard('web')->logout();
        return redirect()->route('user.login');
    }
}
