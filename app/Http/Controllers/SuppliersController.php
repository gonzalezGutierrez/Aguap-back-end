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
        //return response()->json($suppliers);
        return view('administracion.proveedores.supplier', compact(
            'suppliers',
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
        $suppliers = new Suppliers;
        $suppliers->nombre=$request->nombre;
        $suppliers->correo=$request->correo;
        $suppliers->telefono=$request->telefono;
        $suppliers->direccion=$request->direccion;
        $suppliers->save();

        /*return response()->json($suppliers);*/
        return redirect('administracion/proveedores')->with('success', 'Proveedor Agregado!');
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
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
     function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $suppliers = Suppliers::find($request->id);
        if($suppliers){
            $suppliers->delete();
            return redirect('administracion/proveedores')->with('success', 'Proveedor borrado!');
        }
    }

    public function actualizar(Request $request){
        
        $request->all();
        $suppliers = Suppliers::find($request->proveedor_id);
        /*echo '<script>';
        echo 'console.log('. json_encode( $request->edit_nombre ) .')';
        echo '</script>';*/
        if($suppliers){
            $suppliers->nombre = $request->edit_nombre;
            $suppliers->correo = $request->edit_correo;
            $suppliers->telefono = $request->edit_telefono;
            $suppliers->direccion = $request->edit_direccion;
            $suppliers->save();
            return redirect('administracion/proveedores')->with('success', 'Proveedor Actualizado!');
        }else{
            return redirect('administracion/proveedores')->with('failed', 'Proveedor no Actualizado!');
        }
    }
}
