<?php

namespace App\Http\Controllers;

use App\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    /**
     * Получение записей на прием в определенную дату и к определенному врачу
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        $appp = Appointment::where('doctor_id', $request->get('doctorId'))->whereBetween('start', [
            Carbon::parse($request->get('date').' 00:00:00')->format('Y-m-d H:i:s'),
            Carbon::parse($request->get('date').' 23:59:59')->format('Y-m-d H:i:s')
        ])->get();
        return response()->json($appp
            );
    }

    /**
     * Сохранение в БД записи на прием
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'start' => 'required',
            'doctorId' => 'required|integer'
        ]);
        $appointment = Appointment::create([
            'start' => $request->get('start'),
            'doctor_id' => $request->get('doctorId'),
            'visitor_id' => \Auth::user()->roleable->id
        ]);
        $appointment->load(['visitor.user', 'doctor.user']);
        return response()->json($appointment);
    }
}
