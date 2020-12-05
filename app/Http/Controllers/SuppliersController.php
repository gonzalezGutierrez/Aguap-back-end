<?php

namespace App\Http\Controllers;

use App\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Suppliers::all();
        return response()->json($suppliers);
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
        $suppliers = new Suppliers;
        $suppliers->nombre=$request->nombre;
        $suppliers->correo=$request->correo;
        $suppliers->telefono=$request->telefono;
        $suppliers->direccion=$request->direccion;
        $suppliers->save();

        return response()->json($suppliers);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suppliers = Suppliers::find($id);
        if($suppliers){
            $response = [
                'nombre' => $suppliers->nombre,
                'correo' => $suppliers->correo,
                'telefono' => $suppliers->telefono,
                'direccion' => $suppliers->direccion,
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
     * @param  \App\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit(Suppliers $suppliers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->all();
        $suppliers = Suppliers::find($id);
        if($suppliers){
            $suppliers->nombre = $request->nombre;
            $suppliers->correo = $request->correo;
            $suppliers->telefono = $request->telefono;
            $suppliers->direccion = $request->direccion;
            $suppliers->save();
            $response=[
                'nombre' => $suppliers->nombre,
                'correo' => $suppliers->correo,
                'telefono' => $suppliers->telefono,
                'direccion' => $suppliers->direccion,
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
     * @param  \App\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suppliers = Suppliers::find($id);
        if($suppliers){
            $suppliers->delete();
            return response()->json($suppliers);
        }else{
            $response=[
                'message'=>"not found suppliers",
            ];
            return response()->json($response,404);
        }
    }
}
