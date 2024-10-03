@extends('layout.app')

@section('contenido')
<div class="container mt-5 text-center bg-light p-5 rounded" style="max-width:500px; margin: 0 auto;">
    @if(session('mensajeExito'))
    <div class="alert alert-success">
        <h4>
            {{ session('mensajeExito') }}
        </h4>
    </div>
    @endif

    @if(session('titulo'))
    <h1>{{ session('titulo') }}</h1>
    @endif



    <a href="{{ route('crearpedido') }}" class="btn btn-primary mt-3">Realizar un pedido</a>
    <a href="{{ route('pedidos') }}" class="btn btn-warning mt-3">Lista de pedidos</a>
</div>
@endsection