<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
            
            $success = true;
            $message = 'La reservacion se ha registrado exitosamente.';

            return compact('success', 'message');

        } else {

            $success = false;
            $message = 'Ocurrio un error al registrar la reservación.';
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
                $success = true;
                $message = 'La reservacion se cancelo correctamente.';
                return compact('success', 'message');
            }
            else {
                $success = false;
                $message = 'Ocurrio un problema al cancelar la reservación.';
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
