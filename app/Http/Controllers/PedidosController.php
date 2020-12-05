<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class PedidosController extends Controller
{

    public function index(Request $request) {

        $pedidos  = Order::getOrders($request)->actives()->paginate(10);

        $sellers  = User::getUsuariosByRol(2)->pluck('name','idUsuario');

        $customer = $request->customer;
        $idSeller = $request->idSeller;
        $seller   = User::find($idSeller);
        $statusCollect = array(1=>'Creada',2=>'Enviada',3=>'Entregada');
        $status   = $request->status != null ? $request->status : 0;
        $startDate = $request->startDate;
        $endDate   = $request->endDate;

        $mostrarFiltro = $request->filtro == 1;

        return view('administracion.pedidos.index',compact(
            'pedidos',
            'customer',
            'sellers',
            'idSeller',
            'status',
            'mostrarFiltro',
            'seller',
            'startDate',
            'endDate',
            'statusCollect'
        ));

    }

}
