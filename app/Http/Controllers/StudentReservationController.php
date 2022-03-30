<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentReservationController extends Controller
{
    public function indexReservations(){

        $studentId = Auth::guard('student')->user()->id;
        $reservationsReserved = Reservation::where('student_id', $studentId)
                        ->where('status', 'Reservada')
                        ->get();

        return view('reservations.index.indexStudent', compact('reservationsReserved'));
    }

    public function indexReservationsCancelled(){

        $studentId = Auth::guard('student')->user()->id;
        $reservationsCancelled = Reservation::where('student_id', $studentId)
                        ->where('status', 'Cancelada')
                        ->get();
        return view('reservations.cancel.cancelStudent', compact('reservationsCancelled'));
    }

    public function indexReservationsAccepted(){

        $studentId = Auth::guard('student')->user()->id;
        $reservationsAccepted = Reservation::where('student_id', $studentId)
                        ->where('status', 'Aceptada')
                        ->get();
        return view('reservations.accept.acceptStudent', compact('reservationsAccepted'));
    }

    public function indexReservationsRejected(){

        $studentId = Auth::guard('student')->user()->id;
        $reservationsRejected = Reservation::where('attendant_id', $studentId)
                        ->where('status', 'Rechazada')
                        ->get();
        return view('reservations.reject.rejectStudent', compact('reservationsRejected'));
    }

    public function indexReservationsFinished(){

        $studentId = Auth::guard('student')->user()->id;
        $reservationsFinished = Reservation::where('attendant_id', $studentId)
                        ->where('status', 'Finalizada')
                        ->get();
        return view('reservations.finish.finishStudent', compact('reservationsFinished'));
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->status == 'Reservada') {
        
            $reservation->status = "Cancelada";
            DB::table('computers')
                ->where('id', $reservation->computer_id)
                ->update(['status' => 'Disponible']);
            $reservation->save();
            $notification = 'La reservación se ha cancelado correctamente.';
            return back( )->with(compact('notification'));

        } else {

            return back();
        }
    }

    public function cancelPostAccepted(Reservation $reservation)
    {
        if ($reservation->status == 'Aceptada') {
        
            $reservation->status = "Cancelada";
            DB::table('computers')
                ->where('id', $reservation->computer_id)
                ->update(['status' => 'Disponible']);
            $reservation->save();
            $notification = 'Ha cancelado correctamente las reservación tras haberla aceptado por el encargado.';
            return back( )->with(compact('notification'));

        } else {

            return back();
        }
    }
}
