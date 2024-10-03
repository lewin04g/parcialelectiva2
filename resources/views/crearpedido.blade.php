@extends('layout.app')

@section('contenido')
<div class="container">

    @if(session('mensajeExito'))
    <div class="alert alert-success">{{ session('mensajeExito') }}</div>
    @endif


    <form action="{{ route('pedidos.store') }}" method="POST" style="max-width:500px; margin: 0 auto;" class="bg-light p-5 rounded">
        <h2 class="text-center pb-3">Realizar un Pedido</h2>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @csrf

        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre del Medicamento:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre') }}">
            </div>

            <div class="col-md-6">
                <label for="tipo" class="form-label">Tipo de Medicamento:</label>
                <select class="form-select" name="tipo" id="tipo">
                    <option value="" disabled selected>Seleccione un tipo</option>
                    @foreach($tiposMedicamentos as $tipo)
                    <option value="{{ $tipo->id }}" {{ old('tipo') == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre_tipo }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad:</label>
            <input type="number" class="form-control" name="cantidad" id="cantidad" value="{{ old('cantidad') }}">
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <fieldset class="mb-3">
                    <legend>Distribuidor:</legend>
                    @foreach($distribuidores as $distribuidor)
                    <div>
                        <input type="radio" id="distribuidor{{ $distribuidor->id }}" name="distribuidor" value="{{ $distribuidor->id }}" {{ old('distribuidor') == $distribuidor->id ? 'checked' : '' }}>
                        <label for="distribuidor{{ $distribuidor->id }}">{{ $distribuidor->nombre_distri }}</label>
                    </div>
                    @endforeach
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset class="">
                    <legend>Sucursal:</legend>
                    @foreach($sucursales as $sucursal)
                    <div>
                        <input type="checkbox" id="{{ $sucursal->id }}_sucur" name="sucursal[]" value="{{ $sucursal->id }}" {{ is_array(old('sucursal')) && in_array($sucursal->id, old('sucursal')) ? 'checked' : '' }}>
                        <label for="sucursal{{ $sucursal->id }}">{{ $sucursal->nombre_sucur }}</label>
                    </div>
                    @endforeach
                </fieldset>
            </div>
        </div>





        <button type="reset" class="btn btn-secondary">Cancelar</button>
        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
</div>
@endsection