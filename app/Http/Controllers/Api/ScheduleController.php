<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\ScheduleLaboratory;
use Illuminate\Http\Request;


class ScheduleController extends Controller
{
    public function hours(Request $request)
    {
        //dd($request->all());
        $rules = [
            'date' => 'required|date_format:"Y-m-d"',
            'laboratory_id' => 'required|exists:laboratories,id'
        ];
        $this->validate($request, $rules);
        $date = $request->input('date');
        $dateCarbon = new Carbon($date);
        
        $i = $dateCarbon->dayOfWeek;
        $day = ($i==0 ? 6 : $i-1);
        
        $laboratoryId = $request->input('laboratory_id');
        $schedule = ScheduleLaboratory::where('active', true)
                    ->where('day', $day)
                    ->where('laboratory_id', $laboratoryId)
                    ->first([
                            'one_time', 'two_time','three_time',
                            'four_time', 'five_time', 'six_time',
                            'seven_time', 'eight_time','nine_time'
                    ]);
                    //->toArray();
        //$data = [];
        if ($schedule) {

            $data = [
                'one' => date('H:i', strtotime($schedule->one_time)),
                'two' => date('H:i', strtotime($schedule->two_time)),
                'three' => date('H:i', strtotime($schedule->three_time)),
                'four' => date('H:i', strtotime($schedule->four_time)),
                'five' => date('H:i', strtotime($schedule->five_time)),
                'six' => date('H:i', strtotime($schedule->six_time)),
                'seven' => date('H:i', strtotime($schedule->seven_time)),
                'eight' => date('H:i', strtotime($schedule->eight_time)),
                'nine' => date('H:i', strtotime($schedule->nine_time)),
            ];
            
        } else {

            $data = [];
        }
        
        //dd($data);
        //return $schedule->attributesToArray();
        return response()->json($data);
    }


    
}
