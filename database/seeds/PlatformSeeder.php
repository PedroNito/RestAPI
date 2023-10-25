<?php

use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platform = [
            'XBOX One',
            'Playstation 5',
            'PC',
        ];

        for($i = 0; $i < count($platform); $i++){
            DB::table('platforms')->insert([
                'name' => $platform[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
