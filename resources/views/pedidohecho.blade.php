@extends('layout.app')

@section('contenido')
<div class="container mt-5 text-center bg-light p-5 rounded" style="max-width:500px; margin: 0 auto;"">
    @if(session('mensajeExito'))
    <div class=" alert alert-success">
    <h4>
        {{ session('mensajeExito') }}
    </h4>
</div>
@endif
@if(session('titulo'))
<h2 class="py-2">{{ session('titulo') }}</h2>
@endif

@if(session('mensajeMedicamento'))
<p class="ped">{{ session('mensajeMedicamento') }}</p>
@endif
@if(session('mensajeDireccion'))
<p class="ped">{{ session('mensajeDireccion') }}</p>
@endif

<a href="{{ route('crearpedido') }}" class="btn btn-primary mt-3">Realizar otro pedido</a>
<a href="{{ route('pedidos') }}" class="btn btn-warning mt-3">Lista de pedidos</a>
</div>
@endsection