<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class FirebaseController extends Controller
{
    public function postTokenStudent(Request $request)
    {
        $student = Auth::guard('api-student')->user();

        if ($request->has('device_token')) {
            $student->device_token = $request->input('device_token');
            $student->save();
        }
        
    }

    public function postTokenAttendant(Request $request)
    {
        $attendant = Auth::guard('api-attendant')->user();
        if ($request->has('device_token')) {
            $attendant->device_token = $request->input('device_token');
            $attendant->save();
        }
    }

    public function sendNotificationStudent(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'title' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            
            return response()->json([
                'success' => 'false',
                'message' => 'Ocurrio un error al enviar la notifiacion.'
            ]);
        }
        $title = $request->input('title');
        $body =$request->input('body');

        $recipients = Student::whereNotNull('device_token')
            ->pluck('device_token')->toArray();
        fcm()
            ->to($recipients)
            ->notification([
                'title' => $title,
                'body' => $body,
            ])
            ->send();
            
        return response()->json([
            'success' => 'true',
            'message' => 'Notificacion enviada.'
        ]);
}
}
