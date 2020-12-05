@extends('layouts.layout')
@section('content')

    /**************************************************************************************************/
                                    FILTRO DE PEDIDOS
    /**************************************************************************************************/
    <div class="space__header"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">
                        <div class="box-gray">
                            <div class="input-group">
                                <div class="input-group input-group-lg">
                                    <input type="search" placeholder="Buscar por nombre del cliente..." class="form-control" aria-label="Text input with dropdown button">
                                    <div class="input-group-append ">
                                        <button class="btn btn-primary btn-md m-0 px-3 py-2 z-depth-0" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                        <div class="box-gray text-center">
                            <button class="btn btn-primary">
                                <i class="fa fa-filter"></i>
                                Busqueda avanzada
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="space__general_35"></div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-uppercase text-center">codigo pedido</th>
                        <th class="text-uppercase text-center">cliente</th>
                        <th class="text-uppercase text-center">repartidor</th>
                        <th class="text-uppercase text-center">fecha entrega</th>
                        <th class="text-uppercase text-center">estatus</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td class="text-center text-uppercase">{{$pedido->codigoPedido}}</td>
                            <td class="text-center text-uppercase">{{$pedido->nameCustomer.' '.$pedido->lastNameCustomer }}</td>
                            <td class="text-center text-uppercase">{{$pedido->nameSeller.' '.$pedido->lastNameSeller }}</td>
                            <td class="text-center text-uppercase">{{$pedido->fechaEntrega}}</td>
                            <td class="text-center text-uppercase">
                                <span class="badge p-1 {{$pedido->estatus}}">{{$pedido->estatus}}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
