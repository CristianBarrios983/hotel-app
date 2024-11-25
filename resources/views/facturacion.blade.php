@extends('layouts.app') 

@section('content')
    @livewire('facturacion-component', ['reserva' => $reserva])
@endsection