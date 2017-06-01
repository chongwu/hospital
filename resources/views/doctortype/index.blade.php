@extends('layouts.app')

@section('title', 'Типы врачей')

@section('content')
    <div class="container">
        <a href="{{ route('doctor-types.create') }}" class="btn btn-primary">Добавить тип</a>
        @forelse($types as $type)
        @empty
            <p>Типы ещё не добавлены!</p>
        @endforelse
    </div>
@endsection