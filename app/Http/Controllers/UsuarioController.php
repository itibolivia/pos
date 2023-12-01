<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;

use Illuminate\Support\Facades\Hash;

use Inertia\Inertia;

use Carbon\Carbon;

class UsuarioController extends Controller
{
    public function usuarios(){

        $allData =  User::whereHas("roles", function($q){ $q->where("name", "Usuario"); })->get();

        $usuarios = [];

        foreach($allData as $data){
            $usuario = [
                'id' => $data->id,
                'name' => $data->name,
                'email' => $data->email,
                'created_at' => Carbon::parse($data->created_at)->format('d/m/Y')
            ];

            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }

    public function index()
    {
        $usuarios = $this->usuarios();

        return Inertia::render('Usuarios/Index')->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Usuarios/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAsesorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsuarioRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('usuario');

        //return Inertia::render('Asesores/Index')->with('success', 'Creo correctamente!');
        return to_route('usuarios.index');
    }

    public function show(Usuario $usuario)
    {
        //
    }

    public function edit(Usuario $usuario)
    {
        //
    }

    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        dd($request->all());
    }

    public function destroy(Usuario $usuario)
    {
        //
    }
}
