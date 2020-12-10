@extends('layouts.layout')
@section('content')
<div class="space__header"></div>
    <div class="container">
    <div class="space__general_35"></div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                <div class="box text-center">
                    <button type="button" data-toggle="modal" data-target="#createProveedor" 
                         class="btn btn-primary">Agregar Proveedor</button>
                </div>
                
                <div class="modal fade" id="createProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class=" modal-md modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title text-uppercase w-100" id="myModalLabel">
                                    <i class="fas fa-building"></i>
                                    Agregar Proveedor
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form action = "{{route('_proveedores.store')}}" method = "POST" id = "add_proveedor">
                                    @csrf
                                    <div class="md-form mb-5">
                                        <div class="form-group">
                                            <i class="fas fa-truck prefix"></i>
                                            <input type="text" required name="nombre" id="orangeForm-proveedor" class="form-control input-lg validate ">
                                            <label data-error="wrong" data-success="right" for="orangeForm-proveedor">Proveedor</label>
                                        </div>
                                    </div>
                                    <div class="md-form mb-5">
                                        <div class="form-group">
                                            <i class="fas fa-envelope prefix"></i>
                                            <input type="email" required name="correo" id="orangeForm-email" class="form-control validate">
                                            <label data-error="wrong" data-success="right" for="orangeForm-email">Correo</label>
                                        </div>
                                    </div>
                                    <div class="md-form mb-5">
                                        <div class="form-group">
                                            <i class="fa fa-phone prefix"></i>
                                            <input type="tel" required name="telefono" id="orangeForm-phone" class="form-control validate">
                                            <label data-error="wrong" data-success="right" for="orangeForm-phone">Telefono</label>
                                        </div>
                                    </div>
                                    <div class="md-form mb-5">
                                        <div class="form-group">
                                            <i class="fas fa-map-marked-alt prefix"></i>
                                            <input type="text" required name="direccion" id="orangeForm-address" class="form-control validate">
                                            <label data-error="wrong" data-success="right" for="orangeForm-address">Dirección</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" form = "add_proveedor" class="btn btn-primary" >Agregar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>                
                    </div>
                </div>

                <div class="modal fade" id="editProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class=" modal-md modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title text-uppercase w-100" id="myModalLabel">
                                    <i class="fas fa-building"></i>
                                    Editar Proveedor
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action = "{{route('_update_proveedor.actualizar')}}" method = "POST" id = "edit_proveedor">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="proveedor_id" id="proveedor_id" value="">
                                    <label>Proveedor</label>
                                    <div class="md-form mb-5">
                                        <div class="form-group">
                                            <i class="fas fa-truck prefix"></i>
                                            <input type="text" required name="edit_nombre" id="edit_nombre" class="form-control input-lg validate ">
                                            <label data-error="wrong" data-success="right" for="edit_nombres"></label>
                                        </div>
                                    </div>
                                    <label >Correo</label>
                                    <div class="md-form mb-5">
                                        <div class="form-group">
                                            <i class="fas fa-envelope prefix"></i>
                                            <input type="email" required name="edit_correo" id="edit_correo" class="form-control validate">
                                            <label data-error="wrong" data-success="right" for="edit_orangeForm-email"></label>
                                        </div>
                                    </div>
                                    <label >Telefono</label>
                                    <div class="md-form mb-5">
                                        <div class="form-group">
                                            <i class="fa fa-phone prefix"></i>
                                            <input type="tel" required name="edit_telefono" id="edit_telefono" class="form-control validate">
                                            <label data-error="wrong" data-success="right" for="edit_orangeForm-phone"></label>
                                        </div>
                                    </div>
                                    <label >Dirección</label>
                                    <div class="md-form mb-5">
                                        <div class="form-group">
                                            <i class="fas fa-map-marked-alt prefix"></i>
                                            <input type="text" required name="edit_direccion" id="edit_direccion" class="form-control validate">
                                            <label data-error="wrong" data-success="right" for="edit_orangeForm-address"></label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="submit" form = "edit_proveedor" class="btn btn-primary" >Editar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>                
                    </div>
                </div>
                <!-- Delete Warning Modal -->
                <div class="modal modal-danger fade" id="confirm_delete" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Eliminar proveedor</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('_proveedores.destroy', 'id') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" id="id" name="id")>
                                <h5 class="text-center">¿Estas seguro de eliminar a este proveedor?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Borrar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
        <!-- End Delete Modal --> 
            </div>
        </div>

        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-uppercase text-center">Proveedor</th>
                        <th class="text-uppercase text-center">Correo</th>
                        <th class="text-uppercase text-center">Telefono</th>
                        <th class="text-uppercase text-center">Dirección</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($suppliers as $supplieredit)
                        <tr class="data_row">
                            <td class="text-center text-uppercase">{{$supplieredit->nombre}}</td>
                            <td class="text-center text-uppercase">{{$supplieredit->correo}}</td>
                            <td class="text-center text-uppercase">{{$supplieredit->telefono}}</td>
                            <td class="text-center text-uppercase">{{$supplieredit->direccion}}</td>
                            <td><button id="edit-item" data-toggle="modal" data-target="#editProveedor" 
                                data-datos="{{$supplieredit}}" type="button" class="btn btn-primary">Modificar</button></td>
                            <td>
                            <button type="button" data-toggle="modal" data-target="#confirm_delete" data-id="{{$supplieredit->id}}" class="btn btn-danger delete">Eliminar</button>
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

        /*$('#confirm_delete').on('show.bs.modal', function(event) {
            var button =$(event.relatedTarget);
            var data = button.data('id');
            var modal = $(this);
            modal.find('#id_delete').val(data.id);
        })*/
        $(document).on('click','.delete',function(){
         let id = $(this).attr('data-id');
         $('#id').val(id);
        });
    </script>

@stop
