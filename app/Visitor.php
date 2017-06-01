<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
	protected $with = ['user'];

	protected $fillable = ['snils'];

	/**
	 * Получение пользователя, к которому привязвн посетитекль
	 */
	public function user() {
		return $this->morphOne(User::class, 'roleable');
	}

	/**
	 * Получение всех завписей на прием, которые сделал данный пользователь
	 */
	public function appointments() {
		return $this->hasMany(Appointment::class);
	}
}
