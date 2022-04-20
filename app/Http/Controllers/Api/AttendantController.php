<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class AttendantController extends Controller
{
    
    public function indexReservations()
    {
        $attendant = Auth::guard('api-attendant')->user();
        $reservations = $attendant->asAttendantReservations()
        ->where('status', 'Reservada')
        ->with([
            'student' => function($query){
                $query->select('id', 'name', 'num_boleta');

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
                $query->select('id', 'name', 'num_boleta');

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

    public function reservationsAccepted()
    {
        $attendant = Auth::guard('api-attendant')->user();
        $reservations = $attendant->asAttendantReservations()
        ->where('status', 'Aceptada')
        ->with([
            'student' => function($query){
                $query->select('id', 'name', 'num_boleta');

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

    public function reject(Reservation $reservation)
    {
        if ($reservation->status == 'Reservada') {
        
            $reservation->status = "Rechazada";
            DB::table('computers')
                ->where('id', $reservation->computer_id)
                ->update(['status' => 'Disponible']);
            $save = $reservation->save();
            if ($save) {
                
                $success = true;
                $message = 'La reservacion se ha rechazado correctamente';
                return compact('success', 'message');
            }

        } else {

            $success = false;
            $message = 'Ocurrio un error al rechazar la reservacion.';
            return compact('success', 'message');
        }

    }

    public function accept(Reservation $reservation)
    {
        if ($reservation->status == 'Reservada') {
        
            $reservation->status = "Aceptada";
            $reservation->save();
            $save = $reservation->save();
            if ($save) {
                
                $success = true;
                $message = 'La reservacion se ha aceptado correctamente';
                return compact('success', 'message');
            }

        } else {

            $success = false;
            $message = 'Ocurrio un error al rechazar la reservacion.';
            return compact('success', 'message');
        }

    }

    public function finish(Reservation $reservation)
    {
        if ($reservation->status == 'Aceptada') {
        
            $reservation->status = "Finalizada";
            DB::table('computers')
                ->where('id', $reservation->computer_id)
                ->update(['status' => 'Disponible']);
                $save = $reservation->save();
                if ($save) {
                
                    $success = true;
                    $message = 'La reservacion se ha finalizado correctamente';
                    return compact('success', 'message');
                }

        } else {

            $success = false;
            $message = 'Ocurrio un error al finalizar la reservacion.';
            return compact('success', 'message');
        }

    }

    
}

