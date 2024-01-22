<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Http\Requests\StoreCajaRequest;
use App\Http\Requests\UpdateCajaRequest;

use Auth;

class CajaController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreCajaRequest $request)
    {
        $request->merge([
            'user_id' => Auth::user()->id
        ]);
        $caja = new Caja($request->input());
        $caja->save();
        return redirect()->route('notas.index');
    }

    public function show(Caja $caja)
    {
        //
    }

    public function edit(Caja $caja)
    {
        //
    }

    public function update(UpdateCajaRequest $request, Caja $caja)
    {
        //
    }

    public function destroy(Caja $caja)
    {
        //
    }
}
