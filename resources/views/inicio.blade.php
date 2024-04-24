@if(auth()->check())
@extends('index')

@section('inicio')
    <div class="container">
        <div class="row">
            <h1>Inicio</h1>
        </div>
    </div>
@endsection
    
@else
@php
header("Location: " . route('login.index'));
exit();
@endphp
@endif
