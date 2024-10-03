@extends('layout.app')

@section('contenido')
<div class="container mt-5">

    <form action="{{ route('update', $pedido->id) }}" method="POST" style="max-width:500px; margin: 0 auto;" class="bg-light p-5 rounded">
        <h1 class="text-center pb-4">Actualizar Pedido</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Nombre del medicamento</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $pedido->nombre_medicamento) }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="tipo_medicamento">Tipo de Medicamento</label>
                    <select class="form-control" id="tipo_medicamento" name="tipo">
                        @foreach ($tiposdeMedicamentos as $tipo)
                        <option value="{{ $tipo->id }}" {{ $tipo->id == $pedido->id_tipo_medi ? 'selected' : '' }}>
                            {{ $tipo->nombre_tipo }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


        <div class="form-group mb-3">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad', $pedido->cantidad) }}">
        </div>


        <div class="row mb-3">
            <div class="col-md-6">
                <fieldset class="mb-3">
                    <legend>Distribuidor:</legend>
                    @foreach($distribuidores as $distribuidor)
                    <div>
                        <input type="radio"
                            id="distribuidor{{ $distribuidor->id }}"
                            name="distribuidor"
                            value="{{ $distribuidor->id }}"
                            {{ $distribuidor->id == $pedido->id_distri ? 'checked' : '' }}>
                        <label for="distribuidor{{ $distribuidor->id }}">{{ $distribuidor->nombre_distri }}</label>
                    </div>
                    @endforeach
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="mb-4">
                    <legend class="form-label">Sucursal:</legend>
                    @foreach($sucursales as $sucursal)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sucursal[]" value="{{ $sucursal->id }}" id="sucursal_{{ $sucursal->id }}" {{ $pedido->id_sucur == $sucursal->id ? 'checked' : '' }}>
                        <label class="form-check-label" for="sucursal_{{ $sucursal->id }}">
                            {{ $sucursal->nombre_sucur }} - {{ $sucursal->direccion_sucur }}
                        </label>
                    </div>
                    @endforeach
                    @error('sucursal')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </fieldset>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Pedido</button>
        <a href="{{ route('pedidos') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection