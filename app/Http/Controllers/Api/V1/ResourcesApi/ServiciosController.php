<?php

namespace App\Http\Controllers\Api\V1\ResourcesApi;

use App\CatServicio;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Resources\Services\ServiciosCollection;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{

    public function index(Request $request) {

        $status = 0;
        $servicios = CatServicio::getServicios($status);

        ServiciosCollection::withoutWrapping();

        return response()->json([
            'records_count'=>$servicios->count(),
            'servicios'=>new ServiciosCollection($servicios->get())
        ]);

    }

}
