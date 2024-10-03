<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\TipoMedicamento;
use App\Models\Distribuidor;
use App\Models\Distribuidores;
use App\Models\Sucursal;
use App\Models\Sucursales;
use App\Models\Tiposdemedicamentos;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedidos::with(['sucursal', 'distribuidor', 'tipoMedicamento'])->get();
        
        return view('pedidos', compact('pedidos'));
    }
    public function create()
    {
        // Aquí se traen los datos para recorrerlos
        $distribuidores = Distribuidores::all();
        $sucursales = Sucursales::all();
        $tiposMedicamentos = Tiposdemedicamentos::all();




        
        return view('crearpedido', compact('tiposMedicamentos', 'distribuidores', 'sucursales'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|alpha_num',
            'tipo' => 'required|exists:tipos_medicamentos,id',
            'cantidad' => 'required|integer|min:1',
            'distribuidor' => 'required|exists:distribuidores,id',
            'sucursal' => 'required|array',
            'sucursal.*' => 'exists:sucursales,id',
        ]);
        $distribuidor = Distribuidores::find(id: $request->distribuidor);
        $tipoMedicamento = TiposdeMedicamentos::find($request->tipo);

        $sucursales = Sucursales::whereIn('id', $request->sucursal)->get(['nombre_sucur', 'direccion_sucur']);

        // Imprimo el resultado para debuggear
        #dd($sucursales->toArray());

        $nombresSucursales = $sucursales
            ->pluck('nombre_sucur')
            ->toArray();

        $direccionesSucursales = $sucursales
            ->pluck('direccion_sucur')
            ->toArray();

        foreach ($request->sucursal as $id_sucur) {
            Pedidos::create([
                'nombre_medicamento' => $request->nombre,
                'id_tipo_medi' => $request->tipo,
                'cantidad' => $request->cantidad,
                'id_distri' => $request->distribuidor,
                'id_sucur' => $id_sucur
            ]);
        }

        $nombresSucursalesTexto = implode(' y ', $nombresSucursales);
        $direccionesTexto = implode(' y ', $direccionesSucursales);
        $distribuidorNombre = $distribuidor->nombre_distri; 
        $cantidad = $request->cantidad;
        $tipoMedicamentoNombre = $tipoMedicamento->nombre_tipo;
        $nombreMedicamento = $request->nombre;
        $nombresSucursales = $nombresSucursalesTexto;
        $direccionSucursales = $direccionesTexto;

        $titulo = "Pedido al distribuidor " . $distribuidorNombre;
        $mensajeMedicamento = "{$cantidad} unidades del {$tipoMedicamentoNombre} {$nombreMedicamento},";
        $mensajeDireccion = "para la farmacia {$nombresSucursales} situada en {$direccionSucursales}";

        session()->flash('mensajeExito', "Pedido realizado con éxito.");
        session()->flash('titulo', $titulo);
        session()->flash('mensajeMedicamento', $mensajeMedicamento);
        session()->flash('mensajeDireccion', $mensajeDireccion);

        return redirect()->route(route: 'pedidohecho');
    }
    public function edit($id)
    {
        $tiposdeMedicamentos = Tiposdemedicamentos::all();
        $distribuidores = Distribuidores::all();
        $sucursales = Sucursales::all();
        $pedido = Pedidos::with(['distribuidor', 'tipoMedicamento', 'sucursal'])->findOrFail($id);
        

        return view('editarpedido', compact('pedido', 'tiposdeMedicamentos', 'distribuidores', 'sucursales'));
    }
    public function update(Request $request, $id)
    {
        $pedido = Pedidos::findOrFail($id);
        $request->validate([
            'nombre' => 'required|alpha_num',
            'tipo' => 'required|exists:tipos_medicamentos,id',
            'cantidad' => 'required|integer|min:1',
            'distribuidor' => 'required|exists:distribuidores,id',
            'sucursal' => 'required|array|max:1',
            'sucursal.*' => 'exists:sucursales,id',
        ]);
        $pedido->update([
            'nombre_medicamento' => $request->input('nombre'),
            'id_tipo_medi' => $request->input('tipo'),
            'cantidad' => $request->input('cantidad'),
            'id_distri' => $request->input('distribuidor'),
            'id_sucur' => $request->input('sucursal')[0], 
        ]);

        session()->flash('mensajeExito', "Pedido actualizado exitosamente.");
        session()->flash('titulo', "El pedido ha sido actualizado");

        return redirect()->route(route: 'pedidoactualizado');
    }
    public function destroy($id)
    {
        $pedido = Pedidos::findOrFail($id);
        $pedido->delete();
        return redirect()->route('pedidos')->with('success', 'Pedido eliminado con éxito.');
    }
}
