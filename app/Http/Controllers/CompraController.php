<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Inventario;
use App\Models\Producto;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;

use Inertia\Inertia;

use Carbon\Carbon;

use Auth;
use Response;

class CompraController extends Controller
{
    public function precios($id){
        $producto = Producto::find($id);

        return response()->json($producto->precio);
    }

    public function compras(){
        $allData = Compra::all();

        $compras = [];

        foreach($allData as $data){
            $compra = [
                'id' => $data->id,
                'fecha' => Carbon::parse($data->fecha)->format('d/m/Y'),
                'recibo' => $data->recibo,
                'factura' => $data->factura,
            ];

            array_push($compras, $compra);
        }

        return $compras;
    }

    public function index()
    {
        $compras = $this->compras();

        return Inertia::render('Compras/Index', ['compras' => $compras]);
    }

    public function create()
    {
        $productos = Producto::whereActivo('S')->orderBy('nombre')->get();

        return Inertia::render('Compras/Create', ['productos' => $productos]);
    }

    public function store(StoreCompraRequest $request)
    {
        DB::transaction(function () use ($request)  {
            
            //GUARDAR COMPRA
            $compra = new Compra();

            $compra->fecha = $request->fecha;
            $compra->factura = $request->factura;
            $compra->recibo = $request->recibo;
            $compra->user_id = Auth::user()->id;

            $compra->save();
            
            //GUARDA DETALLE DE COMPRA
            foreach ($request->pro as $pro){ 

                $detalle = new DetalleCompra();

                $detalle->cantidad = $pro['cantidad'];
                $detalle->precio = $pro['precio'];
                $detalle->producto_id = $pro['id'];
                $detalle->compra_id = $compra->id;

                $detalle->save();

                //MODIFICA INVENTARIO
                $producto = $pro['id'];

                $exist = Inventario::whereProductoId($producto)->first();

                if($exist){

                    $exist->existencia = $exist->existencia + $pro['cantidad'];
                    $exist->save();

                } else {
                    $inventario = new Inventario();

                    $inventario->existencia = $pro['cantidad'];
                    $inventario->producto_id = $producto;
                    
                    $inventario->save();
                }

            }
        });

        return redirect()->route('compras.index');
    }

    public function show(Compra $compra)
    {
        $detalles = DetalleCompra::with('producto')->whereCompraId($compra->id)->get();

        return Inertia::render('Compras/Show')->with('compra', $compra)->with('detalles', $detalles);
    }

    public function edit(Compra $compra)
    {
        $productos = Producto::whereActivo('S')->orderBy('nombre')->get();

        $detalles = DetalleCompra::with('producto')->whereCompraId($compra->id)->get();

        return Inertia::render('Compras/Update', ['productos' => $productos, 'compra' => $compra, 'detalles' => $detalles]);
    }

    public function update(UpdateCompraRequest $request, Compra $compra)
    {
        DB::transaction(function () use ($request)  {
            $compra = Compra::find($request->id);

            $detalles = DetalleCompra::whereCompraId($request->id)->get();

            // BUSCAR MODIFICACIONES
            foreach($detalles as $detalle){

                foreach($request->pro as $pro){

                    if($pro['id'] == $detalle->producto_id){

                        DetalleCompra::whereId($detalle->id)
                        ->update(['cantidad' => $pro['cantidad'], 'precio' => $pro['precio']]);

                        $exist = Inventario::whereProductoId($detalle->producto_id)->first();

                        $exist->existencia = ($exist->existencia - $detalle->cantidad) + $pro['cantidad'];
                        $exist->save();
                    }

                }
            }

            // BUSCAR BAJAS
            foreach($detalles as $detalle){

                $ban = true;

                foreach($request->pro as $pro){

                    if($pro['id'] == $detalle->producto_id){

                        $ban = false;

                    }

                }

                if($ban){
                    $exist = Inventario::whereProductoId($detalle->producto_id)->first();

                    $exist->existencia = $exist->existencia - $detalle->cantidad;
                    $exist->save();

                    $detalle->delete();
                }
            }

            // BUSCAR ALTAS
            foreach($request->pro as $pro){

                $ban = true;

                foreach($detalles as $detalle){

                    if($pro['id'] == $detalle->producto_id){

                        $ban = false;

                    }

                }

                if($ban){

                    $agregar = new DetalleCompra();

                    $agregar->cantidad = $pro['cantidad'];
                    $agregar->precio = $pro['precio'];
                    $agregar->producto_id = $pro['id'];
                    $agregar->compra_id = $request->id;

                    $agregar->save();

                    $exist = Inventario::whereProductoId($detalle->producto_id)->first();

                    $exist->existencia = $exist->existencia + $detalle->cantidad;
                    $exist->save();
                }
            }

            Compra::whereId($request->id)
            ->update(['fecha' => $request->fecha, 'factura' => $request->factura, 'recibo' => $request->recibo]);
            
        });

        return redirect()->route('compras.index');
    }

    public function destroy(Compra $compra)
    {
        DB::transaction(function () use ($compra)  {
            $compra = Compra::find($compra->id);

            $detalles = DetalleCompra::whereCompraId($compra->id)->get();

            foreach($detalles as $detalle){

                $exist = Inventario::whereProductoId($detalle->producto_id)->first();

                if($exist){
                    $exist->existencia = $exist->existencia - $detalle->cantidad;
                    $exist->save();
                }

                $detalle->delete();
            }
            $compra->delete();
            
        });

        return redirect()->route('compras.index');
    }
}
