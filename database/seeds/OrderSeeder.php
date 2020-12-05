<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

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

    }
}
