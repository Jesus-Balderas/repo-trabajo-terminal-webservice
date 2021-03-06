<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index(){

        $reservations = Reservation::all();

        return view('reservations.index.index', compact('reservations'));
    }

    public function create()
    {
        $laboratories = Laboratory::all();
        return view('reservations.create', compact('laboratories'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $rules = [

            'laboratory_id' => 'required',
            'hour' => 'required',
        ];

        $messages = [

            'hour.between' => 'No seleccionó una hora valida',
        ];

        $this->validate($request, $rules, $messages);
        $student_id = Auth::guard('student')->user()->id;
        $laboratory_id = $request->input('laboratory_id');
        $attendant_id = $request->input('attendant_id');
        $computer_id = $request->input('computer_id');
        $schedule_date = $request->input('scheduled_date');
        $schedule_time = $request->input('hour');

        Reservation::create([
            'laboratory_id' => $laboratory_id,
            'attendant_id' => $attendant_id,
            'computer_id' => $computer_id,
            'student_id' => $student_id,
            'schedule_date' => $schedule_date,
            'schedule_time' => $schedule_time
        ]);

        DB::table('computers')
            ->where('id', $computer_id)
            ->update(['status' => 'Reservada']);

        $notification = 'La reservación se ha registrado exitosamente!';
        return back()->with(compact('notification'));
    }
}
