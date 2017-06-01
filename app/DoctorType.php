<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorType extends Model
{
	/**
	 * Получение списка докторов имеющих данный типу
	 */
	public function doctors() {
		return $this->hasMany(Doctor::class);
    }
}
