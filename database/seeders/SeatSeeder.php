<?php

namespace Database\Seeders;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /**$table->increments('id');
            $table->integer('column-number');
            $table->integer('row-number');
            $table->integer('availability'); // 0 or 1
            $table->unsignedInteger('room-id'); */
        Seat::insert([
            [ #1
                'column-number' => '1',
                'row-number' => '1',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #2
                'column-number' => '2',
                'row-number' => '1',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #3
                'column-number' => '3',
                'row-number' => '1',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #4
                'column-number' => '4',
                'row-number' => '1',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #5
                'column-number' => '5',
                'row-number' => '1',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #6
                'column-number' => '1',
                'row-number' => '2',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #7
                'column-number' => '2',
                'row-number' => '2',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #8
                'column-number' => '3',
                'row-number' => '2',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #9
                'column-number' => '4',
                'row-number' => '2',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #10
                'column-number' => '5',
                'row-number' => '2',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #11
                'column-number' => '1',
                'row-number' => '3',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #12
                'column-number' => '2',
                'row-number' => '3',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #13
                'column-number' => '3',
                'row-number' => '3',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #14
                'column-number' => '4',
                'row-number' => '3',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #15
                'column-number' => '5',
                'row-number' => '3',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #16
                'column-number' => '1',
                'row-number' => '4',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #17
                'column-number' => '2',
                'row-number' => '4',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #18
                'column-number' => '3',
                'row-number' => '4',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #19
                'column-number' => '4',
                'row-number' => '4',
                'availability' => '1',
                'room-id' => '1'
            ],
            [ #20
                'column-number' => '5',
                'row-number' => '4',
                'availability' => '1',
                'room-id' => '1'
            ],
            #Room 2
            [ #1
                'column-number' => '1',
                'row-number' => '1',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #2
                'column-number' => '2',
                'row-number' => '1',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #3
                'column-number' => '3',
                'row-number' => '1',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #4
                'column-number' => '4',
                'row-number' => '1',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #5
                'column-number' => '5',
                'row-number' => '1',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #6
                'column-number' => '1',
                'row-number' => '2',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #7
                'column-number' => '2',
                'row-number' => '2',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #8
                'column-number' => '3',
                'row-number' => '2',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #9
                'column-number' => '4',
                'row-number' => '2',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #10
                'column-number' => '5',
                'row-number' => '2',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #11
                'column-number' => '1',
                'row-number' => '3',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #12
                'column-number' => '2',
                'row-number' => '3',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #13
                'column-number' => '3',
                'row-number' => '3',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #14
                'column-number' => '4',
                'row-number' => '3',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #15
                'column-number' => '5',
                'row-number' => '3',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #16
                'column-number' => '1',
                'row-number' => '4',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #17
                'column-number' => '2',
                'row-number' => '4',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #18
                'column-number' => '3',
                'row-number' => '4',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #19
                'column-number' => '4',
                'row-number' => '4',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #20
                'column-number' => '5',
                'row-number' => '4',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #21
                'column-number' => '1',
                'row-number' => '5',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #22
                'column-number' => '2',
                'row-number' => '5',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #23
                'column-number' => '3',
                'row-number' => '5',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #24
                'column-number' => '4',
                'row-number' => '5',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #25
                'column-number' => '5',
                'row-number' => '5',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #26
                'column-number' => '1',
                'row-number' => '6',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #27
                'column-number' => '2',
                'row-number' => '6',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #28
                'column-number' => '3',
                'row-number' => '6',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #29
                'column-number' => '4',
                'row-number' => '6',
                'availability' => '1',
                'room-id' => '2'
            ],
            [ #30
                'column-number' => '5',
                'row-number' => '6',
                'availability' => '1',
                'room-id' => '2'
            ],
        ]);
    }
}
