<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Room::insert([
            [
                'number_of_seats' => '20'
            ],
            [
                'number_of_seats' => '30'
            ],
        ]);
    }
}
