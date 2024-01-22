<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;

class VentaController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreVentaRequest $request)
    {
        dd($request->all());
    }

    public function show(Venta $venta)
    {
        //
    }

    public function edit(Venta $venta)
    {
        //
    }

    public function update(UpdateVentaRequest $request, Venta $venta)
    {
        //
    }

    public function destroy(Venta $venta)
    {
        //
    }

    public function nota($request)
    {
        $detalles = DetalleNota::whereNotaId($request->nota)->get();

        if($detalles->count()){

            // MODIFICACIONES
            foreach($detalles as $detalle){

                foreach ($request->pro as $pro){ 

                    if($pro['id'] == $detalle->id){
    
                        DetalleNota::whereId($detalle->id)
                        ->update(['cantidad' => $pro['cantidad'], 'precio' => $pro['precio']]);
    
                    }
    
                }

            }
            

            //BAJAS
            foreach($detalles as $detalle){

                $ban = true;

                foreach($request->pro as $pro){

                    if($pro['id'] == $detalle->id){

                        $ban = false;

                    }

                }

                if($ban){

                    $detalle->delete();

                }
            }

            //ALTAS
            foreach($request->pro as $pro){

                $ban = true;

                foreach($detalles as $detalle){

                    if($pro['id'] == $detalle->id){

                        $ban = false;

                    }

                }

                if($ban){

                    $agregar = new DetalleNota();

                    $agregar->cantidad = $pro['cantidad'];
                    $agregar->precio = $pro['precio'];
                    $agregar->producto_id = $pro['productoid'];
                    $agregar->nota_id = $request->nota;

                    $agregar->save();
                }
            }

        } else {

            foreach ($request->pro as $pro){ 

                $detalle = new DetalleNota();
    
                $detalle->cantidad = $pro['cantidad'];
                $detalle->precio = $pro['precio'];
                $detalle->producto_id = $pro['productoid'];
                $detalle->nota_id = $request->nota;
    
                $detalle->save();
                
            }

        }

        return redirect()->back();

    }
}
