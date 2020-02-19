<?php

namespace App\Http\Controllers;

use App\Models\Promotora;
use Illuminate\Http\Request;

class PromotoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Promotora::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Promotora::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotora  $promotora
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Promotora::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotora  $promotora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Promotora::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotora  $promotora
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Promotora::findOrFail($id);
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
        return Promotora::where($request)->get();
    }
}
