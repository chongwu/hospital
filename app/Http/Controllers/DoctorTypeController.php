<?php

namespace App\Http\Controllers;

use App\DoctorType;
use Illuminate\Http\Request;

class DoctorTypeController extends Controller
{

    /**
     * Открытие страницы со списков специализации врачей
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
     * Получение полного перечня специализации врачей, которые ведут прием в системе
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
     * Обновление информации о специализации
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
     * Удаление информации о специализации
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
