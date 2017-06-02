<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	protected $fillable = ['schedule', 'doctor_type_id'];

	protected $with = ['type', 'user'];

	/**
	 * Получить тип доктора
	 */
	public function type() {
		return $this->belongsTo(DoctorType::class, 'doctor_type_id', 'id');
	}

	/**
	 * Получить пользователя, к которому приавязан доктор
	 */
	public function user() {
		return $this->morphOne(User::class, 'roleable');
    }

	/**
	 * Получить все записи на прием к доктору, которые сделали посетители
	 */
	public function appointments() {
		return $this->hasMany(Appointment::class);
	}
}
