@extends('layout.app')

@section('contenido')
<div class="container">
    <h1 class="text-center pb-4">Listado de Pedidos</h1>

    @if($pedidos->isEmpty())
    <div class="alert alert-info text-center">
        No hay pedidos disponibles.
    </div>
    @else
    <table class="table table-bordered table-hover text-center">
        <thead>
            <tr>
                <th>Nombre Medicamento</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Distribuidor</th>
                <th>Sucursal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->nombre_medicamento }}</td>
                <td>{{ $pedido->tipoMedicamento ? $pedido->tipoMedicamento->nombre_tipo : 'No disponible' }}</td>
                <td>{{ $pedido->cantidad }}</td>
                <td>{{ $pedido->distribuidor ? $pedido->distribuidor->nombre_distri : 'No disponible' }}</td>
                <td>{{ $pedido->sucursal ? $pedido->sucursal->nombre_sucur : 'No disponible' }}</td>
                <td>
                    <a href="{{ route('editarpedido', $pedido->id) }}" class="btn btn-warning">Editar</a>
                    <form id="delete-form-{{ $pedido->id }}" action="{{ route('destroy', $pedido->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="{{ $pedido->id }}">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <a href="{{ route('crearpedido') }}" class="btn btn-primary">Realizar Nuevo Pedido</a>
</div>
@endsection