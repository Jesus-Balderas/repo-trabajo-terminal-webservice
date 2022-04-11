<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class StudentController extends Controller
{
    
    public function indexReservations()
    {
        $student = Auth::guard('api-student')->user();
        $reservations =  $student->asStudentReservations()
         ->where('status', 'Reservada')
         ->with([
                    'laboratory' => function($query) {
                        $query->select('id', 'name');
                    },
                    'attendant' => function($query) {
                        $query->select('id', 'name');
                    }, 
                    'computer' => function($query) {
                        $query->select('id', 'num_pc');
                    }
                ])
         ->get([
                "id",
                "laboratory_id",
                "attendant_id",
                "computer_id",
                "schedule_date",
                "schedule_time",
                "status",
                "created_at",
            ]);

         return $reservations;
    }
}
