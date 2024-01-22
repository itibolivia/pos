<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

use App\Models\Categoria;

use Inertia\Inertia;

use Carbon\Carbon;

use Auth;

class ProductoController extends Controller
{
    public function productos(){
        $allData = Producto::all();

        $productos = [];

        foreach($allData as $data){
            $producto = [
                'id' => $data->id,
                'categoria' => $data->categoria->nombre,
                'nombre' => $data->nombre,
                'precio' => $data->precio,
                'descripcion' => $data->descripcion,
                'categoria_id' => $data->categoria_id
                //'activo' => $data->activo,
                //'created_at' => Carbon::parse($data->created_at)->format('d/m/Y')
            ];

            array_push($productos, $producto);
        }

        return $productos;
    }

    public function index()
    {
        $categorias = Categoria::whereActivo('S')->get();

        if($categorias->count() == 0){
            return redirect()->route('categorias.index');
        }

        $productos = $this->productos();
        return Inertia::render('Productos/Index', ['productos' => $productos, 'categorias' => $categorias]);
    }

    public function create()
    {
        $categorias = Categoria::whereActivo('S')->get();

        if($categorias->count() == 0){
            return redirect()->route('categorias.index');
        }
        return Inertia::render('Productos/Create', ['categorias' => $categorias]);
    }

    public function store(StoreProductoRequest $request)
    {
        $filename = null;
        if ($request->hasFile('image'))
        {
            $image = $request->image;
            $filename = time().'_'.$image->getClientOriginalName(); 
            $image->move(public_path('images'), $filename);
        }
        $request->merge([
            'imagen' => $filename,
            'activo' => 'S',
            'user_id' => Auth::user()->id
        ]);
        
        $producto = new Producto($request->input());
        $producto->save();

        return redirect()->back();
    }

    public function show(Producto $Producto)
    {
        //
    }

    public function edit(Producto $Producto)
    {
        //
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $request->merge([
            'user_id' => Auth::user()->id
        ]);
        $producto = Producto::find($producto->id);
        $producto->fill($request->input())->saveorFail();
        return redirect()->back();
    }

    public function destroy(Producto $producto)
    {
        $producto = Producto::find($producto->id);
        $producto->delete();
        return redirect()->back();
    }
}
