<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaboratoryController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }
    */
    
    public function index()
    {
        $laboratories = Laboratory::all();
        return view('laboratories.index', compact('laboratories'));
    }

    public function create()
    {
        return view('laboratories.create');
    }

    private function perfomValidation(Request $request){

        $rules = [
            'name' => 'required|min:10',
            'classroom' => 'required',
            'edifice' => 'required',
            'file_path'=> 'required'
        ];
        $messages = [
            'name.required' => "Es necesario ingresar un nombre.",
            'classroom.required' => "Es necesario ingresar un salon.",
            'edifice.required' => "Es necesario ingresar un numero de edificio.",
            'file_path.required' => "Es necesario adjuntar un horario en formato PDF."
        ];

        $this->validate($request, $rules, $messages);


    }

    public function store(Request $request)
    {
        //dd($request);
        $this->perfomValidation($request);
        try {
            DB::beginTransaction();
            $laboratory = new Laboratory;
            $laboratory->name = $request->input('name');
            $laboratory->classroom = $request->input('classroom');
            $laboratory->edifice = $request->input('edifice');

            if($request->hasFile('file_path')){
                $file = $request->file('file_path');
                $file->move(public_path().'/files/', $file->getClientOriginalName());
                $laboratory->file_path = $file->getClientOriginalName();
            }

            $laboratory->save();
            DB::commit();

        } catch (Exception $e) {
            
            DB::rollBack();
        }

        $notification = 'El laboratorio se ha registrado existosamente.';
        
        return redirect('/laboratories')->with(compact('notification'));
        
    }

    public function edit(Laboratory $laboratory)
    {
        return view('laboratories.edit', compact('laboratory'));
    }

    public function update(Request $request, Laboratory $laboratory)
    {
        $rules = [
            'name' => 'required|min:10',
            'classroom' => 'required',
            'edifice' => 'required',
        ];
        
        $messages = [
            'name.required' => "Es necesario ingresar un nombre.",
            'classroom.required' => "Es necesario ingresar un salon.",
            'edifice.required' => "Es necesario ingresar un numero de edificio.",
        ];

        $this->validate($request, $rules, $messages);

        $laboratory->name = $request->input('name');
        $laboratory->classroom = $request->input('classroom');
        $laboratory->edifice = $request->input('edifice');
        //Se actualiza el archivo PDF en caso de haberse ingresado uno nuevo.
        if($request->hasFile('file_path')){
            $file = $request->file('file_path');
            $file->move(public_path().'/files/', $file->getClientOriginalName());
            $laboratory->file_path = $file->getClientOriginalName();
        }

        $laboratory->save();//UPDATE
        $notification = 'La información del laboratorio se ha actualizado correctamente.';
        return redirect('/laboratories')->with(compact('notification'));
        
    }

    public function destroy(Laboratory $laboratory)
    {
        $deletedLaboratory = $laboratory->name;
        $file_path = public_path().'/files/'. $laboratory->file_path;
        
        if(File::exists($file_path)){
            File::delete($file_path);
        }

        $laboratory->delete();
        $notification = 'El laboratorio '.$deletedLaboratory.' se ha eliminado correctamente.';
        return redirect('/laboratories')->with(compact('notification'));
    }

}
