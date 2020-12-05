<?php

namespace App\Http\Controllers;

use App\Supplies;
use Illuminate\Http\Request;

class SuppliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplies = Supplies::all();
        return response()->json($supplies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->all();
        $supplies = new Supplies;
        $supplies->consumibles=$request->consumibles;
        $supplies->id_proveedores=$request->id_proveedores;
        $supplies->cantidad=$request->cantidad;
        $supplies->save();

        return response()->json($supplies);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplies  $supplies
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplies = Supplies::find($id);
        if($supplies){
            $response = [
                'consumibles' => $supplies->consumibles,
                'id_proveedores' => $supplies->id_proveedores,
                'cantidad' => $supplies->cantidad,
            ];
            return response()->json($response);
        }else{
            $response=['message'=>"error not found"];
            return response()->json($response,404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplies  $supplies
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplies $supplies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplies  $supplies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->all();
        $supplies = Supplies::find($id);
        if($supplies){
            $supplies->consumibles = $request->consumibles;
            $supplies->id_proveedores = $request->id_proveedores;
            $supplies->cantidad = $request->cantidad;
            $supplies->save();
            $response=[
                'consumibles' => $supplies->consumibles,
                'id_proveedores' => $supplies->id_proveedores,
                'cantidad' => $supplies->cantidad,
            ];
            return response()->json($response);
        }else{
            $response=['message'=>"user not found",];
            return response()->json($response,404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplies  $supplies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplies = Supplies::find($id);
        if($supplies){
            $supplies->delete();
            return response()->json($supplies);
        }else{
            $response=[
                'message'=>"not found supplies",
            ];
            return response()->json($response,404);
        }
    }
}
