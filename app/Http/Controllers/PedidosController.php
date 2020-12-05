<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class PedidosController extends Controller
{

    public function index(Request $request) {

        /*$idCliente = $request->idCliente;
        $fechaInicial = $request->fechaIncial;
        $fechaFinal   = $request->fechaFinal;
        $idServicio   = $request->idServicio;*/

        $pedidos      = Order::getOrders($request)->actives()->paginate(10);

        return view('administracion.pedidos.index',compact('pedidos'));

    }

}
