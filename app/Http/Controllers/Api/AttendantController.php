<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendantController extends Controller
{
    
    public function indexReservations()
    {
        $attendant = Auth::guard('api-attendant')->user();
        $reservations =  $attendant->asAttendantReservations;
        return $reservations;
    }

    
}
