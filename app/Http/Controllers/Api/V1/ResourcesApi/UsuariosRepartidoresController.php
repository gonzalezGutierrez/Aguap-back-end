<?php

namespace App\Http\Controllers\Api\V1\ResourcesApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Resources\Users\RepartidoresCollection;
use App\User;
use Illuminate\Http\Request;

class UsuariosRepartidoresController extends Controller
{

    public function index(Request $request) {

        $like = $request->like;

        $estatus = 0; //activo

        $repartidores = User::getUsuarios($like,$estatus)->getUsuariosByRol(2);

        RepartidoresCollection::withoutWrapping();

        return response()->json([
            'records_number'=>$repartidores->count(),
            'usuarios'=>new RepartidoresCollection($repartidores->get())
        ]);

    }

}
