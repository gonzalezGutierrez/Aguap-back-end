<?php

namespace App\Http\Controllers\Api\V1\ResourcesApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Resources\Ubications\UbicationCollection;
use App\Ubication;
use App\User;
use Illuminate\Http\Request;

class UbicacionesClientesController extends Controller
{

    //regresar todas las ubicaciones disponibles del cliente
    public function index(Request $request) {

        $idUsuario = $request->idUsuario; //remplezar por el middleware de usuarios;

        $user      = User::getUsuario($idUsuario);
        $status = 0;

        $ubicaciones = Ubication::getUbicacionesByIdUsuario($status,$idUsuario);

        return response()->json([
            'usuario'=> [
                'id'=>$user->idUsuario,
                'attribites'=>[
                    'nombre'=>$user->nombreRepartidor.' '.$user->apellidoRepartidor
                ]
            ],
            'records_count'=>$ubicaciones->count(),
            'ubicaciones'=> new UbicationCollection($ubicaciones->get())
        ]);
    }

    public function destroy(Request $request){
        $ubication=Ubication::find($request->idUbicacion);
        $eliminado=1;
        $ubication->eliminado=$eliminado;
        $ubication->save();
        return response()->json($ubication,200);
    }
}
