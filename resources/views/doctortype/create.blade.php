@extends('layouts.app')

@section('title', 'Новый тип')

@section('content')
    <div class="container">
        <form class="form-horizontal" method="POST" action="{{ route('doctor-types.store') }}">

        </form>
    </div>
@endsection