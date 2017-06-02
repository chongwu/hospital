@extends('layouts.app')

@section('content')
    <appointment-form :appointment-time="{{ config('appointment.APPOINTMENT_TIME') }}"></appointment-form>
@endsection
