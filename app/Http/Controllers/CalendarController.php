<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Prospecto;

use Auth;

class CalendarController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $prospectos = Prospecto::with('persona')->whereUserId(Auth::user()->id)
        ->whereEstado('Vigente')->get()->pluck('persona.nombre', 'id');

        return Inertia::render('Seguimiento/Index')->with('prospectos', $prospectos);
    }
}
