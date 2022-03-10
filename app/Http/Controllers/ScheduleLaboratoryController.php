<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\ScheduleLaboratory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ScheduleLaboratoryController extends Controller
{
    private $days = [
        'Lunes', 'Martes', 'Miércoles',
        'Jueves', 'Viernes', 'Sábado', 'Domingo'
    ];

    public function index()
    {
        //$schedules = ScheduleLaboratory::all();
        //dd($schedules->toArray());
        //$laboratories=Laboratory::all();
        $schedules = DB::table('schedule_laboratories')
                    ->join('laboratories', 'laboratories.id', '=', 'schedule_laboratories.laboratory_id')
                    ->join('attendants', 'attendants.id', '=','laboratories.attendant_id')
                    ->select('schedule_laboratories.id',
                             'schedule_laboratories.day',
                             'schedule_laboratories.time_start', 
                             'schedule_laboratories.time_end',
                             'laboratories.name as laboratory', 'attendants.name as attendant')
                    ->get();
        return view('scheduleLaboratories.index', compact('schedules'));
    }

    public function create()
    {
        $days = $this->days;
        $laboratories = Laboratory::all(['id', 'name']);
        return view('scheduleLaboratories.create', compact('laboratories', 'days'));
    }

    public function edit($id)
    {
        $days = $this->days;
        $schedule = ScheduleLaboratory::find($id);
        $laboratories = Laboratory::all(['id','name']);
        $laboratory_ids = $schedule->laboratory()->pluck('id');
        //dd($schedule->toArray(), $laboratories, $laboratory_ids);
        return view('scheduleLaboratories.edit', compact('schedule', 'laboratories', 'laboratory_ids', 'days'));

    }

    public function update(Request $request, ScheduleLaboratory $schedule)
    {
        $rules = [

            'day' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
            'laboratories'=> 'required',
        ];

        $messages = [

            'day.required' => 'Es necesario seleccionar un día de la semana',
            'time_start.required' => 'Es necesario seleccionar una hora de inicio',
            'time_end.required' => 'Es necesario seleccionar una hora de fin.',
            'laboratories.required' => 'Es necesario seleccionar un laboratorio.',
        ];

        $this->validate($request, $rules, $messages);

        $schedule->day = $request->get('day');
        $schedule->time_start = $request->get('time_start');
        $schedule->time_end = $request->get('time_end');
        $schedule->laboratory()->associate($request->get('laboratories'));

        if ($schedule->time_start > $schedule->time_end) {
            
            return redirect()->back()->with('fail', 'La hora de inicio no puede ser mayor que la hora de fin.');

        } else {
            
            $schedule->save();
            $notification = "La información del horario se ha actualizado correctamente.";
            return redirect('/schedule')->with(compact('notification'));
        }
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [

            'day' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
            'laboratories'=> 'required',
        ];

        $messages = [

            'day.required' => 'Es necesario seleccionar un día de la semana',
            'time_start.required' => 'Es necesario seleccionar una hora de inicio',
            'time_end.required' => 'Es necesario seleccionar una hora de fin.',
            'laboratories.required' => 'Es necesario seleccionar un laboratorio.',
        ];

        $this->validate($request, $rules, $messages);
        
        $schedule = new ScheduleLaboratory();
        $schedule->day = $request->get('day');
        $schedule->time_start = $request->get('time_start');
        $schedule->time_end = $request->get('time_end');
        $schedule->laboratory()->associate($request->get('laboratories'));
        if ($schedule->time_start > $schedule->time_end) {
            
            return redirect()->back()->with('fail', 'La hora de inicio no puede ser mayor que la hora de fin.');

        } else {
            
            $schedule->save();
            $notification = "El horario se ha registrado correctamente.";
            return redirect('/schedule')->with(compact('notification'));
        }
    }

    public function destroy(ScheduleLaboratory $schedule)
    {
        $schedule->delete();
        $notification = "El horario se ha eliminado correctamente.";
        return redirect('/schedule')->with(compact('notification'));

    }
}
