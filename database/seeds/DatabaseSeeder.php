<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_roles')->insert([
            'rol'=>"administrador",
        ]);
        
        DB::table('tbl_roles')->insert([
            'rol'=>"repartidor",
        ]);

        DB::table('tbl_roles')->insert([
            'rol'=>"cliente",
        ]);

        factory(\App\User::class)->times(200)->create();
        factory(\App\Ubication::class)->times(200)->create();
        factory(\App\CatServicio::class)->times(20)->create();
        factory(\App\TblCostoTipoServicio::class)->times(200)->create();

        /*factory(\App\Order::class)->times(80)->create();
        factory(\App\ServicioOrder::class)->times(150)->create();*/

        $usuarios = \App\User::all();
        $ubicaciones = \App\Ubication::all();
        for ($i = 0; $i<80; $i++) {

            $fechaInicial = "2020-01-01";
            $fechaFinal   = "2020-12-31";

            $milisegundosLimiteInferior = strtotime($fechaInicial);
            $milisegundosLimiteSuperior = strtotime($fechaFinal);

            $milisegundosAleatorios = mt_rand($milisegundosLimiteInferior,$milisegundosLimiteSuperior);

            $fecha = date('Y-m-d',$milisegundosAleatorios);


            $order = new \App\Order();
            $order->idCliente = $usuarios->random()->idUsuario;
            $order->idRepartidor = $usuarios->random()->idUsuario;
            $order->idUbicacion  = $ubicaciones->random()->idUbicacion;
            $order->fechaOrden   = $fecha;
            $order->estatus = 1;
            $order->save();
        }
        $ordenes = \App\Order::all();
        $servicios = \App\CatServicio::all();

        for($i= 0; $i<150; $i++) {
            $servicioOrden = new \App\ServicioOrder();
            $servicioOrden->idOrden = $ordenes->random()->idOrden;
            $servicioOrden->idServicio = $servicios->random()->idServicio;
            $servicioOrden->cantidad   = rand(0,15);
            $servicioOrden->subtotal   = $servicioOrden->cantidad * rand(0,100);
            $servicioOrden->save();
        }
    }
}
