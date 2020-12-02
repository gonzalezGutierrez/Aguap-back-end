<?php

namespace App\Http\Controllers\Api\V1\ResourcesApi;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function show(Request $request) {

        $idUsuario  = $request->idUsuario; // remplazar por el middleware;
        $usuario    = User::findOrFail($idUsuario);

        $order = Order::getOrderByIdCliente($usuario->idUsuario)->first();

        if (!$order) {
            return response()->json([
                'msg'=>'No tienes una orden generada actualmente'
            ],200);
        }

        $order = Order::getOrder($order->idOrden)->first();

        return response()->json($order);



    }

    public function store(Request $request) {

        try {
            $idUsuario  = $request->idUsuario; // remplazar por el middleware;
            $usuario    = User::findOrFail($idUsuario);

            //verificar que el usuario no tenga ningun carrito

            $order = Order::getOrderByIdCliente($usuario->idUsuario)->first();

            if ($order) {
                return response()->json([
                    'msg'=>'Tienes una orden generada actualmente'
                ],200);
            }

            $order = new Order();
            $order->idCliente = $usuario->idUsuario;
            $order->save();

            return response()->json([
                'order'=>$order,
                'msg'=>'La orden se ha creado correctamente'
            ],201);
        }catch (\Exception $exception) {
            return response()->json([
                'msg'=>'Ha ocurrido un error al generar orden',
                'msg-largo'=>$exception->getMessage()
            ],500);
        }

    }


    public function updateRepartidor(Request $request)
    {

        try {
            $idUsuario = $request->idUsuario; // remplazar por el middleware;

            $usuario = User::findOrFail($idUsuario);

            //verificar que el usuario no tenga ningun carrito

            $order = Order::getOrderByIdCliente($usuario->idUsuario)->first();

            if (!$order) { // crear nueva orden
                return response()->json([
                    'msg' => 'No tienes una orden asiganda'
                ], 200);
            }

            $order->idRepartidor = $request->idRepartidor;
            $order->save();

            return response()->json([
                'order' => $order,
                'msg' => 'La orden se ha actualizado correctamente'
            ], 200);

        } catch (\Exception $exception) {

            return response()->json([
                'msg' => 'Ha ocurrido un error al actualizar la orden',
                'msg-largo' => $exception->getMessage()
            ], 500);

        }
    }

    public function updateUbicacion(Request $request) {

        try {
            $idUsuario  = $request->idUsuario; // remplazar por el middleware;

            $usuario    = User::findOrFail($idUsuario);

            //verificar que el usuario no tenga ningun carrito

            $order = Order::getOrderByIdCliente($usuario->idUsuario)->first();

            if (!$order) { // crear nueva orden
                return response()->json([
                    'msg'=>'No tienes una orden asiganda'
                ],200);
            }

            $order->idUbicacion = $request->idUbicacion;
            $order->save();

            return response()->json([
                'order'=>$order,
                'msg'=>'La orden se ha actualizado correctamente'
            ],200);

        }catch (\Exception $exception) {

            return response()->json([
                'msg'=>'Ha ocurrido un error al actualizar la orden',
                'msg-largo'=>$exception->getMessage()
            ],500);

        }





    }

    public function updateFecha(Request $request) {

        try {
            $idUsuario  = $request->idUsuario; // remplazar por el middleware;

            $usuario    = User::findOrFail($idUsuario);

            //verificar que el usuario no tenga ningun carrito

            $order = Order::getOrderByIdCliente($usuario->idUsuario)->first();

            if (!$order) { // crear nueva orden
                return response()->json([
                    'msg'=>'No tienes una orden asiganda'
                ],200);
            }

            $order->fechaOrden = $request->fecha;
            $order->save();

            return response()->json([
                'order'=>$order,
                'msg'=>'La orden se ha actualizado correctamente'
            ],200);

        }catch (\Exception $exception) {

            return response()->json([
                'msg'=>'Ha ocurrido un error al actualizar la orden',
                'msg-largo'=>$exception->getMessage()
            ],500);

        }





    }

}
