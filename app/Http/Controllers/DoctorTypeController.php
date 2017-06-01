<?php

namespace App\Http\Controllers;

use App\DoctorType;
use Illuminate\Http\Request;

class DoctorTypeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('doctortype.index');
    }

    public function getAll()
    {
        return response()->json(DoctorType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required'
        ]);
        $doctorType = DoctorType::create($request->all());
        return response()->json($doctorType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param DoctorType $doctorType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorType $doctorType)
    {
       $this->validate($request, [
           'type' => 'required'
       ]);
       $doctorType->update($request->all());
       return response()->json($doctorType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DoctorType $doctorType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorType $doctorType)
    {
        $doctorType->delete();
        return response('deleted');
    }
}
