@extends('layouts.layout')
@section('content')
<div class="space__header"></div>
    <div class="container">
    <div class="space__general_35"></div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                <div class="box text-center">
                    <button type="button" onclick="agregar()" class="btn btn-primary">Nuevo repartidor</button>
                </div>
            </div>
        </div>

        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-uppercase text-center">ID</th>
                        <th class="text-uppercase text-center">Nombre</th>
                        <th class="text-uppercase text-center">Apellidos</th>
                        <th class="text-uppercase text-center">Correo</th>
                        <th class="text-uppercase text-center">Telefono</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($repartidores as $repartidor)
                        <tr class="data_row">
                            <td class="text-center text-uppercase">{{$repartidor->idUsuario}}</td>
                            <td class="text-center text-uppercase">{{$repartidor->name}}</td>
                            <td class="text-center text-uppercase">{{$repartidor->lastName}}</td>
                            <td class="text-center text-uppercase">{{$repartidor->email}}</td>
                            <td class="text-center text-uppercase">{{$repartidor->phone}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')

    <script>
        $('#editProveedor').on('show.bs.modal', function(event) {
            var button =$(event.relatedTarget);
            var data = button.data('datos');
            var modal = $(this);
            modal.find('.modal-body #proveedor_id').val(data.id);
            modal.find('.modal-body #edit_nombre').val(data.nombre);
            modal.find('.modal-body #edit_correo').val(data.correo);
            modal.find('.modal-body #edit_telefono').val(data.telefono);
            modal.find('.modal-body #edit_direccion').val(data.direccion);
        })

        function agregar() {
            location.replace("http://localhost:8000/register");
        }

        $(document).on('click','.delete',function(){
         let id = $(this).attr('data-id');
         $('#id').val(id);
        });
    </script>

@stop
