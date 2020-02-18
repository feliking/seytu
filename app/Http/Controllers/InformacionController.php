<?php

namespace App\Http\Controllers;

use App\Informacion;
use Illuminate\Http\Request;

class InformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Informacion::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Informacion::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Informacion::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Informacion::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Informacion::findOrFail($id);
        $data->delete();
        return $data;
    }

    /**
     * Busca un elemento especifico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fill($request)
    {
        $request = json_decode($request, true);
        return Informacion::where($request)->get();
    }
}
