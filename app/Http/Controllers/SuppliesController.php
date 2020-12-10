<?php

namespace App\Http\Controllers;

use App\Supplies;
use App\Suppliers;
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
        /*SELECT supplies.consumibles, supplies.id_proveedores, suppliers.nombre, supplies.cantidad FROM 
        `supplies` INNER JOIN `suppliers` on supplies.id_proveedores = suppliers.id 
        GROUP BY id_proveedores */
        $proveedores_elegibles = Suppliers::pluck('nombre','idSupplier');

        /*$supplies = Supplies::all();*/

        $_supplies_ = Supplies::select("supplies.id",
                                        "supplies.consumibles",
                                        "supplies.idSupplier",
                                        "suppliers.nombre as provee_name",
                                        "supplies.cantidad")
                                        ->join("suppliers", "supplies.idSupplier", "=", "suppliers.idSupplier")
                                        ->get();

        return view('administracion.insumos.supplie', compact(
            'proveedores_elegibles',
            '_supplies_',
        ));
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
        /*echo '<script>';
        echo 'console.log('. json_encode( $request->idProveedor ) .')';
        echo '</script>';*/
        $supplies = new Supplies;
        $supplies->consumibles=$request->consumibles;
        $supplies->idSupplier=$request->idProveedor;
        $supplies->cantidad=$request->cantidad;
        $supplies->save();

        return redirect('administracion/insumos')->with('success', 'Insumo Agregado!');
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
                'idSupplier' => $supplies->idSupplier,
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
            $supplies->idSupplier = $request->id_proveedores;
            $supplies->cantidad = $request->cantidad;
            $supplies->save();
            $response=[
                'consumibles' => $supplies->consumibles,
                'idSupplier' => $supplies->id_proveedores,
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
    public function destroy(Request $request)
    {
        $supplies = Supplies::find($request->id);
        if($supplies){
            $supplies->delete();
            return redirect('administracion/insumos')->with('success', 'Proveedor borrado!');
        }
    }

    public function actualizar(Request $request){
        
        $request->all();
        $supplies = Supplies::find($request->insumos_id);
        /*echo '<script>';
        echo 'console.log('. json_encode( $request->id ) .')';
        echo '</script>';*/
        if($supplies){
            $supplies->consumibles = $request->edit_consumibles;
            $supplies->idSupplier = $request->id;
            $supplies->cantidad = $request->edit_cantidad;
            $supplies->save();
            return redirect('administracion/insumos')->with('success', 'Proveedor Actualizado!');
        }else{
            return redirect('administracion/insumos')->with('failed', 'Proveedor no Actualizado!');
        }
    }
}
