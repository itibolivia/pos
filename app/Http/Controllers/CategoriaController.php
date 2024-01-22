<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;

use Inertia\Inertia;

use Carbon\Carbon;

use Auth;

class CategoriaController extends Controller
{
    public function categorias(){
        $allData = Categoria::all();

        $categorias = [];

        foreach($allData as $data){
            $categoria = [
                'id' => $data->id,
                'nombre' => $data->nombre,
                'activo' => $data->activo,
                'created_at' => Carbon::parse($data->created_at)->format('d/m/Y')
            ];

            array_push($categorias, $categoria);
        }

        return $categorias;
    }

    public function index()
    {
        $categorias = $this->categorias();
        return Inertia::render('Categorias/Index', ['categorias' => $categorias]);
    }

    public function create()
    {
        //
    }

    public function store(StoreCategoriaRequest $request)
    {
        $request->merge([
            'activo' => 'S',
            'user_id' => Auth::user()->id
        ]);
        $categoria = new Categoria($request->input());
        $categoria->save();

        return redirect()->back();
    }

    public function show(Categoria $categoria)
    {
        //
    }

    public function edit(Categoria $categoria)
    {
        //
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $request->merge([
            'user_id' => Auth::user()->id
        ]);
        $categoria = Categoria::find($categoria->id);
        $categoria->fill($request->input())->saveorFail();
        return redirect()->back();
    }

    public function destroy(Categoria $categoria)
    {
        $categoria = Categoria::find($categoria->id);
        $categoria->delete();
        return redirect()->back();
    }
}
