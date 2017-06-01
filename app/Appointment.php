<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['start', 'visitor_id', 'doctor_id'];

    protected $with = ['visitor', 'doctor'];

	/**
	 * Получение посетителя, который записался на прием
	 */
	public function visitor() {
		return $this->belongsTo(Visitor::class);
    }

	/**
	 * Получение доктора, к которому записались на прием
	 */
	public function doctor() {
		return $this->belongsTo(Doctor::class);
    }
}
