@extends('layouts.app')

@section('title', 'Новый тип')

@section('content')
    <div class="container">
        {!! Form::open(['route' => 'doctor-types.store']) !!}
            <div class="form-group">
                {{ Form::label('type', 'Тип') }}
                {{ Form::text('type', old('type'), ['class' => 'form-control']) }}
            </div>
        <div class="form-group">
            {{ Form::button('Добавить', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
        {!! Form::close() !!}
    </div>
@endsection