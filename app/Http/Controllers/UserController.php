<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd('llego');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function viewformulario()
    {
        return view('formulario');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

//    public function buscar(Request $request)
//    {
//        $user = User::find($request->id);
//        return view('editar', compact('user'));
//    }

//    public function editar(Request $request){
//    $user = User::find($request->id);

//    if ($user) {
//        $user->name = $request->name;
//        $user->save();
//        return redirect('/buscar')->with('success', 'Usuario actualizado correctamente.');
//    } else {
//        return redirect('/buscar')->with('error', 'Usuario no encontrado.');
//    }}

//    public function buscarUserPerfil(Request $request)
//    {
//        $user = User::find($request->id);
//        return view('editar', compact('user'));
//    }
}
