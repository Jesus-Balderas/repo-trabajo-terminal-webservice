<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $careers = Career::all();//= SELECT * FROM
        return view('careers.index', compact('careers'));
    }

    public function create()
    {
        return view('careers.create');
    }

    private function perfomValidation(Request $request){

        $rules = [
            'name' => 'required|min:10'
        ];
        $messages = [
            'name.required' => "Es necesario ingresar un nombre.",
            'name.min' => "Como mínimo el nombre de la carrera debe tener 10 caracteres"
        ];

        $this->validate($request, $rules, $messages);


    }

    public function store(Request $request)
    {
        $this->perfomValidation($request);

        $career = new Career();
        $career->name = $request->input('name');
        $career->save();
        
        $notification = 'La carrera se ha registrado existosamente.';
        
        return redirect('/careers')->with(compact('notification'));
    }

    public function edit(Career $career){

        return view('careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career){

        $this->perfomValidation($request);

        $career->name = $request->input('name');
        $career->save();
        $notification = 'La carrera se ha actualizado correctamente.';

        return redirect('/careers')->with(compact('notification'));
    }

    public function destroy(Career $career)
    {
        $deletedCareer = $career->name;
        $career->delete();
        $notification = 'La carrera '.$deletedCareer.' se ha eliminado correctamente.';
        return redirect('/careers')->with(compact('notification')); 
    }


}
