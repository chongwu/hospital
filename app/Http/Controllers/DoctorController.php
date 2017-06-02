<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Открытие заглавной страницы со списком докторов
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('doctor.index');
    }

    /**
     * Получение списка докторов
     *
     * @return \Illuminate\Http\JsonResponse
     */
	public function getAll() {
		return response()->json(Doctor::all()->toArray());
    }

    /**
     * Сохранение в БД только что добавленного доктора,
     * паролем для доктора будет адрес эл. почты
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = new User([
	        'name' => $request->get('name'),
	        'email' => $request->get('email'),
	        'password' => bcrypt($request->get('email')),
        ]);
        $newDoctor = Doctor::create([
        	'doctor_type_id' => $request->get('type'),
	        'schedule' => json_encode($request->get('schedule'))
        ]);
	    $newDoctor->user()->save($user);
	    $newDoctor->load(['type', 'user']);
        return response()->json($newDoctor);
    }


	/**
	 * Обновление информации о докторе
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param Doctor $doctor
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function update(Request $request, Doctor $doctor)
    {
        $user = $doctor->user;
        $user->update([
	        'name' => $request->get('name'),
	        'email' => $request->get('email'),
        ]);
        $doctor->update([
	        'doctor_type_id' => $request->get('type'),
	        'schedule' => json_encode($request->get('schedule'))
        ]);
        $doctor->load(['type', 'user']);
        return response()->json($doctor);
    }

	/**
	 * Удаление из БД информации о докторе
	 *
	 * @param Doctor $doctor
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response('deleted');
    }
}
