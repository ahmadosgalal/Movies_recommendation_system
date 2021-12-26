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
            $table->integer('column_number');
            $table->integer('row_number');
            $table->integer('availability'); // 0 or 1
            $table->unsignedInteger('room_id'); */
        Seat::insert([
            [ #1
                'column_number' => '1',
                'row_number' => '1',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #2
                'column_number' => '2',
                'row_number' => '1',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #3
                'column_number' => '3',
                'row_number' => '1',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #4
                'column_number' => '4',
                'row_number' => '1',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #5
                'column_number' => '5',
                'row_number' => '1',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #6
                'column_number' => '1',
                'row_number' => '2',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #7
                'column_number' => '2',
                'row_number' => '2',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #8
                'column_number' => '3',
                'row_number' => '2',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #9
                'column_number' => '4',
                'row_number' => '2',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #10
                'column_number' => '5',
                'row_number' => '2',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #11
                'column_number' => '1',
                'row_number' => '3',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #12
                'column_number' => '2',
                'row_number' => '3',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #13
                'column_number' => '3',
                'row_number' => '3',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #14
                'column_number' => '4',
                'row_number' => '3',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #15
                'column_number' => '5',
                'row_number' => '3',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #16
                'column_number' => '1',
                'row_number' => '4',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #17
                'column_number' => '2',
                'row_number' => '4',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #18
                'column_number' => '3',
                'row_number' => '4',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #19
                'column_number' => '4',
                'row_number' => '4',
                'availability' => '1',
                'room_id' => '1'
            ],
            [ #20
                'column_number' => '5',
                'row_number' => '4',
                'availability' => '1',
                'room_id' => '1'
            ],
            #Room 2
            [ #1
                'column_number' => '1',
                'row_number' => '1',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #2
                'column_number' => '2',
                'row_number' => '1',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #3
                'column_number' => '3',
                'row_number' => '1',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #4
                'column_number' => '4',
                'row_number' => '1',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #5
                'column_number' => '5',
                'row_number' => '1',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #6
                'column_number' => '1',
                'row_number' => '2',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #7
                'column_number' => '2',
                'row_number' => '2',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #8
                'column_number' => '3',
                'row_number' => '2',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #9
                'column_number' => '4',
                'row_number' => '2',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #10
                'column_number' => '5',
                'row_number' => '2',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #11
                'column_number' => '1',
                'row_number' => '3',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #12
                'column_number' => '2',
                'row_number' => '3',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #13
                'column_number' => '3',
                'row_number' => '3',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #14
                'column_number' => '4',
                'row_number' => '3',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #15
                'column_number' => '5',
                'row_number' => '3',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #16
                'column_number' => '1',
                'row_number' => '4',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #17
                'column_number' => '2',
                'row_number' => '4',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #18
                'column_number' => '3',
                'row_number' => '4',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #19
                'column_number' => '4',
                'row_number' => '4',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #20
                'column_number' => '5',
                'row_number' => '4',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #21
                'column_number' => '1',
                'row_number' => '5',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #22
                'column_number' => '2',
                'row_number' => '5',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #23
                'column_number' => '3',
                'row_number' => '5',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #24
                'column_number' => '4',
                'row_number' => '5',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #25
                'column_number' => '5',
                'row_number' => '5',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #26
                'column_number' => '1',
                'row_number' => '6',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #27
                'column_number' => '2',
                'row_number' => '6',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #28
                'column_number' => '3',
                'row_number' => '6',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #29
                'column_number' => '4',
                'row_number' => '6',
                'availability' => '1',
                'room_id' => '2'
            ],
            [ #30
                'column_number' => '5',
                'row_number' => '6',
                'availability' => '1',
                'room_id' => '2'
            ],
        ]);
    }
}
