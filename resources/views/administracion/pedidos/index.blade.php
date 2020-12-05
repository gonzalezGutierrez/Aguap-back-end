@extends('layouts.layout')
@section('content')

    /**************************************************************************************************/
                                    FILTRO DE PEDIDOS
    /**************************************************************************************************/
    <div class="space__header"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <form id="formOrders" action="{{asset('administracion/pedidos')}}" method="GET">
                    <input type="hidden" name="filtro" value="1">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">
                            <div class="box-gray">
                                <div class="input-group">
                                    <div class="input-group input-group-lg">
                                        <input type="search" autofocus id="customer" name="customer" value="{{$customer}}" placeholder="Buscar por nombre del cliente..." class="form-control text-uppercase" aria-label="Text input with dropdown button">
                                        <div class="input-group-append ">
                                            <button type="submit" class="btn btn-primary btn-md m-0 px-3 py-2 z-depth-0">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                            <div class="box-gray text-center">
                                <button type="button" data-toggle="modal" data-target="#centralModalSm" class="btn btn-primary">
                                    <i class="fa fa-filter"></i>
                                    Busqueda avanzada
                                </button>
                            </div>
                            <div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                 aria-hidden="true">

                                <!-- Change class .modal-sm to change the size of the modal -->
                                <div class=" modal-md modal-dialog modal-full-height modal-right" role="document">


                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h4 class="modal-title text-uppercase w-100" id="myModalLabel">
                                                <i class="fas fa-filter"></i>
                                                Filtro avanzado
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        {!! Form::label('idSeller','Filtro por vendedor',['class'=>' label-sm']) !!}
                                                        {!! Form::select('idSeller',$sellers,$idSeller,['class'=>'form-control form-control-lg','placeholder'=>'Selecciona un elemento...']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row text-center">
                                                <div class="col-12">
                                                    <h4 class="text-uppercase text-bold">Filtro entre fechas</h4>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        {!! Form::label('startDate','Fecha Inicial',['class'=>' label-sm']) !!}
                                                        {!! Form::date('startDate',$startDate,['class'=>'form-control','form-control-lg']) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        {!! Form::label('endDate','Fecha Final',['class'=>' label-sm']) !!}
                                                        {!! Form::date('endDate',$endDate,['class'=>'form-control','form-control-lg']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4 class="text-uppercase text-bold">Filtro por estatus</h4>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        {!! Form::select('status',[0=>'Selecciona un elemento...',1=>'Creada',2=>'Enviada',3=>'entregada'],$status,['class'=>'form-control form-control-lg','id'=>'status']) !!}
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-sm">Guardar Cambios</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-2">
            @if($mostrarFiltro)
                <div class="col-md-12">
                    <span class="badge mr-2 {{$customer == null ? 'd-none' : ''}} creada p-1">
                        Palabra clave: {{$customer}}
                        <i id="onEmptyCustomer" class="fas fa-times-circle cursor-pointer"></i>
                    </span>

                    <span class="badge mr-2 {{$idSeller == null ? 'd-none' : ''}} creada p-1">
                        Repartidor: {{$idSeller != null ? $seller->name.' '. $seller->lastName: ''}}
                        <i id="onEmptySeller" class="fas fa-times-circle cursor-pointer"></i>
                    </span>

                    <span class="badge {{$startDate == null && $endDate == null ? 'd-none' : ''}} creada p-1">
                        Fecha Inicial: {{$startDate != null ? $startDate : ''}} - Fecha Final: {{$endDate != null ? $endDate : ''}}
                        <i id="onEmptyDates" class="fas fa-times-circle cursor-pointer"></i>
                    </span>

                    <span class="badge {{$status == 0 ? 'd-none' : ''}} creada p-1">
                        Estatus: {{$status != 0 ? $statusCollect[$status] : ''}}
                        <i id="onEmptyStatus" class="fas fa-times-circle cursor-pointer"></i>
                    </span>
                </div>
            @endif
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

@section('js')

    <script>

        document.getElementById("idSeller").addEventListener("change",()=>{
            showLoading();
            sendForm();
        });

        document.getElementById("status").addEventListener("change",()=>{
            showLoading();
           sendForm();
        });


        let onEmptyCustomer = document.getElementById("onEmptyCustomer");

        onEmptyCustomer.addEventListener("click",() => {
            showLoading();
            document.getElementById("customer").value = '';
            document.getElementById("formOrders").submit();
        });

        let onEmptySeller = document.getElementById("onEmptySeller");

        onEmptySeller.addEventListener("click",()=>{
            showLoading();
            document.getElementById("idSeller").value = '';
            document.getElementById("formOrders").submit();
        });

        let onEmptyStatus = document.getElementById("onEmptyStatus");

        onEmptyStatus.addEventListener("click",()=>{
            showLoading();
            document.getElementById("status").value = '';
            document.getElementById("formOrders").submit();
        });

        let onEmptyDates = document.getElementById("onEmptyDates");

        onEmptyDates.addEventListener("click",()=>{
            showLoading();
            document.getElementById("endDate").value = '';
            document.getElementById("startDate").value = '';
            document.getElementById("formOrders").submit();
        });



        function sendForm() {
            document.getElementById("formOrders").submit();
        }

        var onFormSubmit = "";

        $('#customer').on("keyup",function(){
            clearTimeout(onFormSubmit);
            onFormSubmit = setTimeout(sendForm(), 500);
        });

    </script>

@stop
