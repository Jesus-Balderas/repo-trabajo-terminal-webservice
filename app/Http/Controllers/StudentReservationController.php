<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use Illuminate\Http\Request;

class StudentReservationController extends Controller
{
    public function indexReservations(){

        $studentId = Auth::guard('student')->user()->id;
        $reservationsReserved = Reservation::where('student_id', $studentId)
                        ->where('status', 'Reservada')
                        ->get();

        return view('appointments.index.indexStudent', compact('reservationsReserved'));
    }
}
