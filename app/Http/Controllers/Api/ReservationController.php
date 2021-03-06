<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;

class ReservationController extends Controller
{
    
    public function store(Request $request) {

        $rules = [

            'laboratory_id' => 'required',
            'scheduled_hour' => 'required',
        ];
    
        $messages = [
    
            'scheduled_hour.required' => 'Es necesario seleccionar una hora.',
        ];
    
        $this->validate($request, $rules, $messages);
        $student_id = Auth::guard('api-student')->user()->id;
        $laboratory_id = $request->input('laboratory_id');
        $attendant_id = $request->input('attendant_id');
        $computer_id = $request->input('computer_id');
        $schedule_date = $request->input('scheduled_date');
        $schedule_time = $request->input('scheduled_hour');
        $attendant = Attendant::find($attendant_id);

        $exists = Reservation::where('laboratory_id', $laboratory_id)
                  ->where('student_id', $student_id)
                  ->where('schedule_date', $schedule_date)
                  ->where('status', 'Reservada')
                  ->exists();

        if($exists){

            $success = false;
            $message = 'Ya tienes una reservación para ese día en el laboratorio que seleccionaste';
            return compact('success', 'message');

        } else {

            $reservation = Reservation::create([
                'laboratory_id' => $laboratory_id,
                'attendant_id' => $attendant_id,
                'computer_id' => $computer_id,
                'student_id' => $student_id,
                'schedule_date' => $schedule_date,
                'schedule_time' => $schedule_time
            ]);
                DB::table('computers')
                ->where('id', $computer_id)
                ->update(['status' => 'Reservada']);

            if ($reservation) {

                $attendant->sendFCM('¡Ha recibido una nueva solicitud de reservación!');
                $success = true;
                $message = 'La reservacion se ha registrado exitosamente.';
    
                return compact('success', 'message');
    
            } else {
    
                $success = false;
                $message = 'Ocurrio un error al registrar la reservación.';
                return compact('success', 'message');
            }
        }
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->status == 'Reservada') {
        
            $reservation->status = "Cancelada";
            DB::table('computers')
                ->where('id', $reservation->computer_id)
                ->update(['status' => 'Disponible']);
            $save = $reservation->save();
            
            if ($save) {
                $reservation->attendant->sendFCM('¡Se ha cancelado una solicitud de reservación!');
                $success = true;
                $message = 'La reservacion se cancelo correctamente.';
                return compact('success', 'message');
            }
            
        } 
        else {
            $success = false;
                $message = 'No se puede cancelar la reservación.';
                return compact('success', 'message');
        }
        
    }
    
}
