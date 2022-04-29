<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function reservations(){

        $attendant = Auth::guard('api-attendant')->user();
        $laboratory = $attendant->laboratories;

        $reject = $attendant->asAttendantReservations()
        ->where('status','Rechazada')->count();

        $cancel = $attendant->asAttendantReservations()
        ->where('status', 'Cancelada')->count();

        $finish = $attendant->asAttendantReservations()
        ->where('status', 'Finalizada')->count();
        
        return compact('laboratory', 'reject', 'cancel', 'finish');
    }
}
