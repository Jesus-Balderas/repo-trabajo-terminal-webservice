<?php

namespace App\Http\Controllers;

use App\Models\Attendant;
use App\Models\Student;
use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    public function sendAll(Request $request)
    {
        $students = Student::whereNotNull('device_token')
            ->pluck('device_token')->toArray();
        $attendants = Attendant::whereNotNull('device_token')
            ->pluck('device_token')->toArray();

        $recipients = array_merge($students, $attendants);

        fcm()
            ->to($recipients)
            ->notification([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
            ])
            ->send();
            
        $notification = 'Notificación enviada a todos los usuarios (Android)';
        return back()->with(compact('notification'));
    }
}
