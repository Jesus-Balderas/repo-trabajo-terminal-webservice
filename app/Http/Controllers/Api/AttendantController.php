<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    
}
