<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Laboratory;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function index($id)
    {
        $laboratories = Laboratory::where('id', $id)->get();
        $computers = Computer::where('laboratory_id', $id)->paginate(5);
        $computersList = Computer::where('laboratory_id', $id)->get();
        $computerCount = $computersList->count();
        return view('computers.index', compact('laboratories', 'computers', 'computerCount'));
    }

    public function create($id)
    {
        $laboratories = Laboratory::where('id', $id)->get();
        return view('computers.create', compact('laboratories'));
    }

    public function store(Request $request)
    {
        //dd($request->toArray());

        $rules = [
            'computers' => 'required'
            
        ];

        $messages = [
            'computers.required' => "Es necesario ingresar un número de computadoras."
        ];

        $this->validate($request, $rules, $messages);

        $laboratories = $request->input('laboratories');
        $computers = (int)$request->input('computers');
        for ($i=1; $i <= $computers ; $i++) { 

            Computer::create([
                'num_pc' => $i,
                'status' => 'DISPONIBLE',
                'laboratory_id' => $laboratories
            ]);
        }

        $notification = 'Las computadoras se han registrado existosamente.';
        return redirect('/laboratory/computers/'.$laboratories, compact('notification'));

    }

    
}
