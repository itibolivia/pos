<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Inertia\Inertia;

use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $allData =  User::whereHas("roles", function($q){ $q->where("name", "Admin"); })->get();

        $admins = [];

        foreach($allData as $data){
            $admin = [
                'id' => $data->id,
                'name' => $data->name,
                'email' => $data->email,
                'created_at' => Carbon::parse($data->created_at)->format('d/m/Y')
            ];

            array_push($admins, $admin);
        }

        return Inertia::render('Admins/Index')->with('admins', $admins);
    }

    public function create()
    {
        return Inertia::render('Admins/Create');
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('admin');

        //return Inertia::render('Admins/Index')->with('success', 'Creo correctamente!');
        return to_route('admins.index');
    
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        dd($request->all());
    }

    public function destroy($id)
    {
        //
    }
}
