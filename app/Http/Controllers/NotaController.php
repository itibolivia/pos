<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\DetalleNota;
use App\Http\Requests\StoreNotaRequest;
use App\Http\Requests\UpdateNotaRequest;

use App\Models\Caja;
use App\Models\Categoria;
use App\Models\Producto;

use Inertia\Inertia;

use Carbon\Carbon;

use Auth;

use DB;

class NotaController extends Controller
{
    public function index()
    {
        $caja = Caja::latest()->first();

        if($caja){
            if($caja->estado=="abrir"){
                $estado_caja = $caja->estado;
                $id_caja = $caja->id;
            } else {
                $estado_caja = '';
                $id_caja = 0;
            }
            
        } else {
            $estado_caja = '';
            $id_caja = 0;
        }

        $notas = Nota::whereEstado('abierta')->get();

        $categorias = Categoria::whereActivo('S')->get();

        $productos = Producto::whereActivo('S')->get();

        return Inertia::render('Pos/Index' , [
            'estado_caja'=>$estado_caja,
            'id_caja' => $id_caja,
            'notas' => $notas, 
            'categorias' => $categorias,
            'productos' => $productos
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreNotaRequest $request)
    {
        $request->merge([
            'fecha' => Carbon::now(),
            'user_id' => Auth::user()->id
        ]);
        $nota = new Nota($request->input());
        $nota->save();
        return redirect()->route('notas.index');
    }

    public function show(Nota $nota)
    {
        //
    }

    public function edit(Nota $nota)
    {
        //
    }

    public function update(UpdateNotaRequest $request, Nota $nota)
    {
        //
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id)  {
            $nota = Nota::find($id);

            $detalles = DetalleNota::whereNotaId($id)->get();

            foreach($detalles as $detalle){

                $detalle->delete();

            }
            
            $nota->delete();
            
        });

        return redirect()->route('notas.index');
    }
}
