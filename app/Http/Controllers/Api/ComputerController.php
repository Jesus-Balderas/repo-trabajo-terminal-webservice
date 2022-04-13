<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Computer;

class ComputerController extends Controller
{
    public function computers(Request $request) {

        $rules = [
            'laboratory_id' => 'required|exists:laboratories,id'
        ];
        $this->validate($request, $rules);
        $laboratory = $request->input('laboratory_id');
        $computers = Computer::where('status', 'Disponible')
                    ->where('laboratory_id', '=', $laboratory)
                    ->orderBy('num_pc', 'asc')
                    ->get(['id','num_pc']);
                    
        return response()->json($computers);

    }
}
