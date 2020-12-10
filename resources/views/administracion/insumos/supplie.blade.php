@extends('layouts.layout')
@section('content')
<div class="space__header"></div>
    <div class="container">
    <div class="space__general_35"></div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                <button type="button" data-toggle="modal" data-target="#createInsumo" 
                    class="btn btn-primary">Agregar Articulo</button>
            </div>
            <div class="modal fade " id="createInsumo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class=" modal-sm modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title text-uppercase w-100" id="myModalLabel">
                                <i class="fas fa-water"></i>
                                Agregar Articulo
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action = "{{route('_insumos.store')}}" method = "POST" id = "add_insumo">
                                @csrf
                                <div class="md-form mb-5">
                                    <div class="form-group">
                                        <i class="fas fa-bong prefix"></i>
                                        <input type="text" required name="consumibles" id="orangeForm-proveedor" class="form-control input-lg validate ">
                                        <label data-error="wrong" data-success="right" for="orangeForm-proveedor">Consumible</label>
                                    </div>
                                </div>
                                <i class="fas fa-truck prefix"></i>
                                <label>Proveedor</label>
                                <div class="md-form mb-5">
                                    <div class="form-group">
                                        {!! Form::select('idProveedor', $proveedores_elegibles, null, ['class' => 'form-control input-lg' , 'placeholder'=>'Selecciona un proveedor']) !!} 
                                    </div>
                                </div>
                                <div class="md-form mb-5">
                                    <div class="form-group">
                                        <i class="fas fa-dolly prefix"></i>
                                        <input type="text" required  name="cantidad" id="orangeForm-phone" class="form-control input-lg validate">
                                        <label data-error="wrong" data-success="right" for="orangeForm-phone">Cantidad</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form = "add_insumo" id="add" class="btn btn-primary" >Agregar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>                
                </div>
            </div>

            <div class="modal fade " id="editInsumo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class=" modal-sm modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title text-uppercase w-100" id="myModalLabel">
                                <i class="fas fa-water"></i>
                                Editar Articulo
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action = "{{route('_update_insumos.actualizar')}}" method = "POST" id = "edit_insumo">
                                @csrf
                                <input type="hidden" name="insumos_id" id="insumos_id" value="">
                                <label>Consumible</label>
                                <div class="md-form mb-5">
                                    <div class="form-group">
                                        <i class="fas fa-bong prefix"></i>
                                        <input type="text" required name="edit_consumibles" id="edit_consumibles" class="form-control input-lg validate ">
                                        <label data-error="wrong" data-success="right" for="orangeForm-proveedor"></label>
                                    </div>
                                </div>
                                <i class="fas fa-truck prefix"></i>
                                <label>Proveedor</label>
                                <div class="md-form mb-5">
                                    <div class="form-group">
                                        
                                        <select class="form-control" name="id" id="seleccionados_">
                                            <option>Selecciona un proveedor</option>
                                            @foreach ($proveedores_elegibles as $id => $nombre)
                                                <option value="{{ $id }}"> {{ $nombre }} </option>
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>
                                <label>Cantidad</label>
                                <div class="md-form mb-5">
                                    <div class="form-group">
                                        <i class="fas fa-dolly prefix"></i>
                                        <input type="text" required name="edit_cantidad" id="edit_cantidad" class="form-control input-lg validate">
                                        <label data-error="wrong" data-success="right" for="orangeForm-phone"></label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form = "edit_insumo" id="add" class="btn btn-primary" >Editar</button>
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
                                <h4 class="modal-title" id="exampleModalLabel">Eliminar Articulo</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('_insumos.destroy', 'id') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" id="id" name="id")>
                                <h5 class="text-center">¿Estas seguro de eliminar a este articulo?</h5>
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

        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-uppercase text-center">Insumo</th>
                        <th class="text-uppercase text-center">Proveedor</th>
                        <th class="text-uppercase text-center">Disponibilidad</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($_supplies_ as $insumo)
                        <tr class="data_row">
                            <td class="text-center text-uppercase">{{$insumo->consumibles}}</td>
                            <td class="text-center text-uppercase">{{$insumo->provee_name}}</td>
                            <td class="text-center text-uppercase">{{$insumo->cantidad}}</td>
                            <td><button id="edit-item" data-toggle="modal" data-target="#editInsumo" 
                                data-datos="{{$insumo}}" type="button" class="btn btn-primary">Modificar</button></td>
                            <td>
                            <button type="button" data-toggle="modal" data-target="#confirm_delete" data-id="{{$insumo->id}}" class="btn btn-danger delete">Eliminar</button>
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
     $('#editInsumo').on('show.bs.modal', function(event) {
            var button =$(event.relatedTarget);
            var data = button.data('datos');
            var modal = $(this);
            console.log(data);
            modal.find('.modal-body #insumos_id').val(data.id);
            modal.find('.modal-body #edit_consumibles').val(data.consumibles);
            modal.find('.modal-body #seleccionados_').val(data.idSupplier);
            modal.find('.modal-body #edit_cantidad').val(data.cantidad);
        })
    $(document).on('click','.delete',function(){
        let id = $(this).attr('data-id');
        $('#id').val(id);
    });
    </script>

@stop
