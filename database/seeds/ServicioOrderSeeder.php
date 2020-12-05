<?php

use Illuminate\Database\Seeder;

class ServicioOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
