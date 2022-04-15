<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendantController extends Controller
{
    
    public function indexReservations()
    {
        $attendant = Auth::guard('api-attendant')->user();
        $reservations = $attendant->asAttendantReservations()
        ->where('status', 'Reservada')
        ->with([
            'student' => function($query){
                $query->select('id', 'name');

            },
            'computer' => function($query){
                $query->select('id', 'num_pc');
            }
        ])
        ->get([
            "id",
            "student_id",
            "computer_id",
            "schedule_date",
            "schedule_time",
            "status",
            "created_at",
        ]);

        return $reservations;
    }

    public function reservationHistory()
    {
        $attendant = Auth::guard('api-attendant')->user();
        $reservations = $attendant->asAttendantReservations()
        ->whereIn('status', ['Rechazada', 'Cancelada', 'Finalizada'])
        ->with([
            'student' => function($query){
                $query->select('id', 'name');

            },
            'computer' => function($query){
                $query->select('id', 'num_pc');
            }
        ])
        ->get([
            "id",
            "student_id",
            "computer_id",
            "schedule_date",
            "schedule_time",
            "status",
            "created_at",
        ]);

        return $reservations;
    }

}

