<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use App\Http\Resources\Agenda as AgendaResource;

use Inertia\Inertia;

use Carbon\Carbon;

use Auth;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = [];
        
        if(Auth::user()->hasRole('asesor')){
            $agenda = Agenda::whereUserId(Auth::user()->id)->get();
        }

        if(Auth::user()->hasRole('gerente')){
            $agenda = Agenda::all();
        }

        return response()->json(AgendaResource::collection($agenda));
    }

    public function create()
    {
        //
    }

    public function store(StoreAgendaRequest $request)
    {
        $agenda = Agenda::create([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'accion' => $request->accion,
            'prospecto_id' => $request->prospecto,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back();
    }

    public function show(Agenda $agenda)
    {
        //
    }

    public function edit(Agenda $agenda)
    {
        //
    }

    public function update(UpdateAgendaRequest $request, Agenda $agenda)
    {
        //
    }

    public function destroy(Agenda $agenda)
    {
        //
    }
}
