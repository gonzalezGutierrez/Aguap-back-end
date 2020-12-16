<?php

namespace App\Http\Controllers\Api\V1\ResourcesApi;

use App\CatServicio;
use App\Http\Controllers\Controller;
use App\Order;
use App\ServicioOrder;
use App\TblCostoTipoServicio;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
//vista de usuarios
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
        $cliente = User::findOrFail($order->idCliente);

        $total     = ServicioOrder::where('idOrden',$order->idOrden)->sum('subtotal');
        $servicios = ServicioOrder::getServiciosByOrderId($order->idOrden)->get();

        $client = array(
            'name' => $cliente->name,
            'lastName' => $cliente->lastName,
            'email' => $cliente->email,
            'phone' => $cliente->phone
        );

        return response()->json([
            'order'=>$order,
            'cliente'=>$client,
            'total'=>$total,
            'servicios'=>$servicios
        ]);
    }
//vista de repartidoes (ordenes activas)
    public function OrdenesActivas(Request $request){
        $pedidosActivos = Order::getOrdersByDeliver($request->idRepartidor)->get();
        $pedidos ['pedidoss'] = array();
        
        foreach ($pedidosActivos as $activos){
            $order = Order::getOrderByIdCliente($activos->idCliente)->first();
            $order = Order::getOrder($order->idOrden)->first();
            $cliente = User::findOrFail($order->idCliente);
            $total     = ServicioOrder::where('idOrden',$order->idOrden)->sum('subtotal');
            $servicios = ServicioOrder::getServiciosByOrderId($order->idOrden)->get();
            $client = array(
                'name' => $cliente->name,
                'lastName' => $cliente->lastName,
                'email' => $cliente->email,
                'phone' => $cliente->phone
            );
            $results = array(
                'Orden' => $order,
                'cliente' => $client,
                'total' => $total,
                'servicios' => $servicios
            );
            $pedidos ['pedidoss'][] = $results;
        }
        return response()->json([
            'repartidor'=>$request->idRepartidor,
            'activos'=>$pedidos,
            'msg'=>'pedidos activos'
        ],200);
    }
//crear los pedidos
    public function crear_pedidos(Request $request){
        $request->all();
        $servicioOrden = new ServicioOrder();
            $servicioOrden->idOrden    = $request->idOrden;
            $servicioOrden->idServicio = $request->idServicio;
            $servicioOrden->cantidad   = $request->cantidad;
            $servicioOrden->subtotal   = $request->subtotal;
            $servicioOrden->save();
            return response()->json([
                'Pedido'=>$servicioOrden,
                'msg'=>'El pedido se ha agregado'
            ],201);
    }
//historial del repartidor
    public function historialRepartidor(Request $request){
        $pedidosActivos = Order::getOrdersByDeliverHistorial($request->idRepartidor)->get();
        $pedidos ['pedidoss'] = array();
        
        foreach ($pedidosActivos as $activos){
            $order = Order::getOrderByIdClienteHitorial($activos->idCliente)->first();
            $order = Order::getOrder($order->idOrden)->first();
            $cliente = User::findOrFail($order->idCliente);
            $total     = ServicioOrder::where('idOrden',$order->idOrden)->sum('subtotal');
            $servicios = ServicioOrder::getServiciosByOrderId($order->idOrden)->get();
            $client = array(
                'name' => $cliente->name,
                'lastName' => $cliente->lastName,
                'email' => $cliente->email,
                'phone' => $cliente->phone
            );
            $results = array(
                'Orden' => $order,
                'cliente' => $client,
                'total' => $total,
                'servicios' => $servicios
            );
            $pedidos ['pedidoss'][] = $results;
        }
        return response()->json([
            'repartidor'=>$request->idRepartidor,
            'activos'=>$pedidos,
            'msg'=>'pedidos activos'
        ],200);
    }
//crear las ordenes
    public function store(Request $request) {

        try {
            $request->all();
            $usuario = User::findOrFail($request->idCliente);

            //verificar que el usuario no tenga ningun carrito

            $order = Order::getOrderByIdCliente($usuario->idUsuario)->first();

            if ($order) {
                return response()->json([
                    'idOrden' => $order->idOrden,
                    'msg'=>'Tienes una orden generada actualmente'
                ],200);
            }

            $order = new Order();
            $order->idCliente    = $request->idCliente;
            $order->idRepartidor = $request->idRepartidor;
            $order->idUbicacion  = $request->idUbicacion;
            $order->fechaOrden   = $request->fechaOrden;
            $order->estatus       = $request->estatus;
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

//actualiza el pedido (entregado)
    public function Despachado(Request $request){
        try {
            $orden = Order::where('idOrden',$request->idOrden)->first();
            $orden->estatus = '1';
            $orden->save();
            return response()->json([
                'orden' => $orden,
                'msg' => 'La orden se ha despachado'
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'msg' => 'Ha ocurrido un error al actualizar la orden',
                'msg-largo' => $exception->getMessage()
            ], 500);
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

    public function addServicio(Request $request) {

        try {
            $idUsuario = $request->idUsuario;

            $usuario    = User::findOrFail($idUsuario);

            //verificar que el usuario no tenga ningun carrito

            $order = Order::getOrderByIdCliente($usuario->idUsuario)->first();

            if (!$order) { // crear nueva orden
                return response()->json([
                    'msg'=>'No tienes una orden asiganda'
                ],200);
            }

            $servicio = CatServicio::findOrFail($request->idServicio);

            $costo    = TblCostoTipoServicio::where('idServicio',$servicio->idServicio)->first();

            $servicio = new ServicioOrder();
            $servicio->idOrden = $order->idOrden;
            $servicio->idServicio = $request->idServicio;
            $servicio->cantidad  = $request->cantidad;
            $servicio->subtotal  = ($request->cantidad * $costo->costo);

            $servicio->save();

            return response()->json([
                'msg'=>'El servicio fue agregado a la orden',
                'servicio'=>$servicio
            ]);

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

}
