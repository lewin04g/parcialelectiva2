<?php

use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;


Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos');

Route::get('/pedidos/crear', [PedidoController::class, 'create'])->name('crearpedido');

Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');

Route::get('/pedidos/pedidohecho', function () {
    return view('pedidohecho');
})->name('pedidohecho');

Route::get('/pedidos/{id}/editar', [PedidoController::class, 'edit'])->name('editarpedido');

Route::put('/pedidos/{id}', [PedidoController::class, 'update'])->name('update');

Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->name('destroy');

Route::get('/pedido-actualizado', function () {
    return view('pedidoactualizado'); 
})->name('pedidoactualizado');

Route::get('/', function () {
    return redirect()->route('pedidos');
});
