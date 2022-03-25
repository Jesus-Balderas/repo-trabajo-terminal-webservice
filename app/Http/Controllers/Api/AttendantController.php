<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AttendantController extends Controller
{
    
    public function getReservationsReserved(Request $request)
    {
        $attendantId = $request->input('attendant_id');

        $reservation = Reservation::join('students', 'reservations.student_id', '=', 'students.id')
                        ->join('computers', 'reservations.computer_id', '=', 'computers.id')
                        ->select('reservations.id', 'students.num_boleta as boleta', 'students.name as student',
                                 'computers.num_pc', 'reservations.status', 'reservations.schedule_date', 
                                 'reservations.schedule_time')
                        ->where('reservations.attendant_id', '=', $attendantId)
                        ->get(['id', 'boleta', 'student','num_pc', 'status', 'schedule_date','schedule_time']);
        return $reservation;
    }
}
