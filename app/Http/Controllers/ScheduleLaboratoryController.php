<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\ScheduleLaboratory;
use Illuminate\Http\Request;

class ScheduleLaboratoryController extends Controller
{
    private $days = [
        'Lunes', 'Martes', 'Miércoles',
        'Jueves', 'Viernes'
    ];

    public function edit($id)
    {
        $laboratories = Laboratory::where('id', $id)->get();
        $scheduleLaboratories = ScheduleLaboratory::where('laboratory_id', $id)->get();

        if (count($scheduleLaboratories) > 0) {
            
            $days = $this->days;
            return view('scheduleLaboratories.schedule', compact('days', 'laboratories', 'scheduleLaboratories'));

        } else {

            $scheduleLaboratories = collect();
            for ($i=0; $i < 5; $i++) { 

                $days = $this->days;
                $scheduleLaboratories->push(new ScheduleLaboratory());
                
            }
            return view('scheduleLaboratories.schedule', compact('days', 'laboratories', 'scheduleLaboratories'));
        }
        //dd($scheduleLaboratories->toArray());

    }

    

    public function store($id, Request $request)
    {
        //dd($request->toArray(), $id);

        $active = $request->input('active') ?: [];
        $one_time = $request->input('one_time');
        $two_time = $request->input('two_time');
        $three_time = $request->input('three_time');
        $four_time = $request->input('four_time');
        $five_time = $request->input('five_time');
        $six_time = $request->input('six_time');
        $seven_time = $request->input('seven_time');
        $eight_time = $request->input('eight_time');
        $nine_time = $request->input('nine_time');

        for ($i=0; $i<5; $i++) { 
            
            ScheduleLaboratory::updateOrCreate(
                [
                    'day' => $i,
                    'laboratory_id' => $id,
                ],
                [
                    'active' => in_array($i, $active),
                    'one_time' => $one_time[$i],
                    'two_time' => $two_time[$i],
                    'three_time' => $three_time[$i],
                    'four_time' => $four_time[$i],
                    'five_time' => $five_time[$i],
                    'six_time' => $six_time[$i],
                    'seven_time' => $seven_time[$i],
                    'eight_time' => $eight_time[$i],
                    'nine_time' => $nine_time[$i],
                ]
            );
        }

        $notification = 'Los cambios se han guardado correctamente.';
        return back()->with(compact('notification'));
    }

}
