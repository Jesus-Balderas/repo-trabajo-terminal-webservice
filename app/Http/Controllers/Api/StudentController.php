<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    
    public function getReservationsReserved(Request $request)
    {
        $studentId = $request->input('student_id');

        $reservation = Reservation::join('laboratories', 'reservations.laboratory_id', '=', 'laboratories.id')
                        ->join('computers', 'reservations.computer_id', '=', 'computers.id')
                        ->join('attendants', 'reservations.attendant_id', '=', 'attendants.id')
                        ->select('reservations.id', 'laboratories.name as laboratory', 'attendants.name as attendant',
                                 'computers.num_pc', 'reservations.status', 'reservations.schedule_date', 
                                 'reservations.schedule_time')
                        ->where('reservations.student_id', '=', $studentId)
                        ->get(['id', 'laboratory', 'attendant', 'num_pc', 'status', 'schedule_date', 'schedule_time']);
        return $reservation;         
        
    }
}
