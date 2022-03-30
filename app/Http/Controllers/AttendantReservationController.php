<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AttendantReservationController extends Controller
{
    public function indexReservations(){

        $attendantId = Auth::guard('attendant')->user()->id;
        $reservationsReserved = Reservation::where('attendant_id', $attendantId)
                        ->where('status', 'Reservada')
                        ->get();

        return view('appointments.index.indexAttendant', compact('reservationsReserved'));
    }

    public function indexReservationsAceppted(){

        $attendantId = Auth::guard('attendant')->user()->id;
        $reservationsAccepted = Reservation::where('attendant_id', $attendantId)
                        ->where('status', 'Aceptada')
                        ->get();
        return view('appointments.accept.acceptAttendant', compact('reservationsAccepted'));
    }

    public function indexReservationsRejected(){

        $attendantId = Auth::guard('attendant')->user()->id;
        $reservationsRejected = Reservation::where('attendant_id', $attendantId)
                        ->where('status', 'Rechazada')
                        ->get();
        return view('appointments.reject.rejectAttendant', compact('reservationsRejected'));
    }

    public function indexReservationsFinished(){

        $attendantId = Auth::guard('attendant')->user()->id;
        $reservationsFinished = Reservation::where('attendant_id', $attendantId)
                        ->where('status', 'Finalizada')
                        ->get();
        return view('appointments.finish.finishAttendant', compact('reservationsFinished'));
    }

    //Este metodo rechaza una solicitud de reservación por parte del encargado
    public function reject(Reservation $reservation)
    {
        if ($reservation->status == 'Reservada') {
        
            $reservation->status = "Rechazada";
            DB::table('computers')
                ->where('id', $reservation->computer_id)
                ->update(['status' => 'Disponible']);
            $reservation->save();
            $notification = 'La reservación se ha rechazado correctamente.';
            return back( )->with(compact('notification'));

        } else {

            return back();
        }

    }

    public function accept(Reservation $reservation)
    {
        if ($reservation->status == 'Reservada') {
        
            $reservation->status = "Aceptada";
            $reservation->save();
            $notification = 'La reservación se ha aceptado correctamente.';
            return back( )->with(compact('notification'));

        } else {

            return back();
        }

    }

    public function finish(Reservation $reservation)
    {
        if ($reservation->status == 'Aceptada') {
        
            $reservation->status = "Finalizada";
            DB::table('computers')
                ->where('id', $reservation->computer_id)
                ->update(['status' => 'Disponible']);
            $reservation->save();
            $notification = 'La reservación se ha finalizado correctamente.';
            return back( )->with(compact('notification'));

        } else {

            return back();
        }

    }
}
