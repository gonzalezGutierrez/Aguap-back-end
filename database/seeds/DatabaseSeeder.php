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
        $this->call([
            RolTableSeed::class
        ]);

        factory(\App\User::class)->times(200)->create();
        factory(\App\Ubication::class)->times(200)->create();
        factory(\App\CatServicio::class)->times(20)->create();
        factory(\App\TblCostoTipoServicio::class)->times(200)->create();

        /*factory(\App\Order::class)->times(80)->create();
        factory(\App\ServicioOrder::class)->times(150)->create();*/

        $this->call([
            OrderSeeder::class,
            ServicioOrderSeeder::class
        ]);
    }
}
