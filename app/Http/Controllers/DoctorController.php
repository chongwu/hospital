<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('doctor.index');
    }

	public function getAll() {
		return response()->json(Doctor::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request, [
//        	'schedule' => 'required',
	        'doctor_type_id' => 'required',
	        'name' => 'required:string',
	        'email' => 'required|email'
        ]);*/
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
	 * Update the specified resource in storage.
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
	 * Remove the specified resource from storage.
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
