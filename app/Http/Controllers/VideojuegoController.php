<?php

namespace App\Http\Controllers;

use App\Models\Desarrolladora;
use Illuminate\Http\Request;

use App\Models\Videojuego;
use Illuminate\Support\Facades\Gate;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videojuegos = auth()->user()->videojuegos;
        return view("videojuegos.index", ["videojuegos"=>$videojuegos]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("videojuegos.create",["desarrolladoras"=>Desarrolladora::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anyo' => 'integer'
        ]);

        Videojuego::create([
            "titulo" => $request->titulo,
            "anyo" => $request->anyo,
            "desarrolladora_id" => $request->desarrolladora_id,
        ]);
        return redirect()->route("videojuegos.index");    }

    /**
     * Display the specified resource.
     */
    public function show(Videojuego $videojuego)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $videojuego)

    {
        if (!Gate::allows('update', $videojuego)) {
            abort(403);
        }

        return view("videojuegos.edit", ["videojuego" => $videojuego, "desarrolladoras"=>Desarrolladora::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videojuego $videojuego)
    {
        $request->validate([
            'anyo' => 'integer'
        ]);
        $videojuego->update([
            "titulo" => $request->titulo,
            "anyo" => $request->anyo,
            "desarrolladora_id" => $request->desarrolladora_id,

        ]);
        return redirect()->route("videojuegos.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojuego $videojuego)
    {
        $videojuego->delete();
        return redirect()->route("videojuegos.index");
    }

    public function poseoIndex()
    {
        return view("videojuegos.poseoIndex", ["videojuegos" =>Videojuego::all()]);
    }
    public function poseoCreate(Request $request)
    {
        $videojuego = Videojuego::where("id", $request->videojuego_id)->first();
        $user = auth()->user();
        if ($request->opcion == "Lo tengo"){
            if(!$videojuego->users->find($user->id)){
                $videojuego->users()->attach($user->id);
                $info = "El juego ha sido añadido a su lista";
            }else{
                $info = "EL juego ya se encontraba en ese estado";
            }
        }else if($request->opcion == "No lo tengo"){
            if($videojuego->users->find($user->id)){
                $videojuego->users()->detach($user->id);
                $info = "El juego ha sido eliminado de su lista";
            }
            else{
                $info = "EL juego ya se encontraba en ese estado";

            }
        }

        return redirect()->route("videojuegos.poseo")->with('info', $info);
    }
}
