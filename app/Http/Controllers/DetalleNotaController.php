<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Nota;
use App\Models\DetalleNota;

use Inertia\Inertia;

use Carbon\Carbon;

use Auth;
use Response;

class DetalleNotaController extends Controller
{
    public function carrito($id)
    {
        $detalles = DetalleNota::whereNotaId($id)->get();

        $carrito = [];

        foreach($detalles as $detalle){
            $producto = [
                'id' => $detalle->id,
                'cantidad' => $detalle->cantidad,
                'precio' => $detalle->precio,
                'productoid' => $detalle->producto_id,
                'nombre' => $detalle->producto->nombre,
                'categoria' => $detalle->producto->categoria_id,
                'nota' => $detalle->nota_id
            ];

            array_push($carrito, $producto);
        }

        return response()->json($carrito);
    }

    public function guardar(Request $request)
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
