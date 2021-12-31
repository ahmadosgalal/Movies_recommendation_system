<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieSeat;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class MoviesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $movies = Movie::all();
        return $movies;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->json(['message' => 'this is the add movie form page']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator()->make($request->all(), [
            'title' => 'required|string|max:255',
            'date' => 'required|date|after:yesterday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'screen' => 'required|integer|in:1,2',
            'poster' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Something went wrong', 'ErrorsIn' => $validator->getMessageBag()], 400);
        } else {



            $condition = true;
            $condition = DB::table('movies')
                ->where([
                    ['screen', '=', $request->screen],
                    ['date', '=', $request->date],
                    ['end_time', '>', $request->start_time],
                    ['start_time', '<', $request->end_time]
                ])
                ->count();
            #print($condition);
            if (!$condition) {
                $movie = Movie::create([
                    'title' => $request->title,
                    'date' => $request->date,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'screen' => $request->screen,
                    'poster' => '',
                ]);
                $Image = $request->file('poster');
                $ImageName = '/movie_poster_' . $movie->id . '.' . $Image->getClientOriginalExtension();
                $path = $request->file('poster')->move(public_path('/imgs/movies_posters'), $ImageName);
                $PhotoUrl = '/imgs/movies_posters' . $ImageName;
                $movie->poster = $PhotoUrl;
                $movie->save();

                $this->addSeats($movie->id, $request->screen);

                return response()->json(['message' => 'Successfully added the movie'], 201);
            } else {
                return response()->json(['message' => 'The room is not available'], 409);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return  Movie::findorFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $movie = Movie::findorFail($id);
        return $movie;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator()->make($request->all(), [
            'title' => 'required|string|max:255',
            'date' => 'required|date|after:yesterday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'screen' => 'required|integer|in:1,2',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Something went wrong', 'ErrorsIn' => $validator->getMessageBag()], 400);
        } else {
            $movie = Movie::findOrFail($id);
            if ($movie) {
                //delete the image first..
                if ($request->file('poster') != null) {
                    $poster_image = $movie->poster;
                    $imagepath = public_path() . $poster_image;
                    if ($imagepath) {
                        File::delete($imagepath);
                    } else {
                        $movie->poster = '';
                    }
                    //then update with the new poster..
                    $Image = $request->file('poster');
                    $ImageName = '/movie_poster_' . $movie->id . '.' . $Image->getClientOriginalExtension();
                    $path = $request->file('poster')->move(public_path('/imgs/movies_posters'), $ImageName);
                    $PhotoUrl = '/imgs/movies_posters' . $ImageName;
                    $movie->poster = $PhotoUrl;
                }
                //print ($request -> title);
                $movie->title = $request->title;
                $movie->date = $request->date;
                $movie->start_time = $request->start_time;
                $movie->end_time = $request->end_time;
                $movie->screen = $request->screen;
                $movie->updated_date = now();
                //print($movie);

                $condition = true;
                $condition = DB::table('movies')
                    ->where([
                        ['id', '!=', $id],
                        ['screen', '=', $request->screen],
                        ['date', '=', $request->date],
                        ['end_time', '>', $request->start_time],
                        ['start_time', '<', $request->end_time]
                    ])
                    ->count();

                if (!$condition) {
                    $movie->save();

                    return response()->json(['message' => 'Successfully updated the movie'], 201);
                } else {
                    return response()->json(['message' => 'New slot is not available, not updated'], 409);
                }
            } else {
                return response()->json(['message' => 'Movie does not exist'], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function seats($id)
    {
        //
        /* $seats = DB::table('movie_seats') -> where('movie_id', '=',$id)->first();
        foreach ($seats as $seat) {
            print_r( $seat);
        } */
        $seats = DB::table('seats')
            ->where('movie_id', '=', $id)
            ->join('movie_seats', 'seats.id', '=', 'movie_seats.seat_id')
            ->select('seats.id', 'seats.column_number', 'seats.row_number', 'movie_seats.available')
            ->get();
        return $seats;
    }

    /**
     * Store relations between seats and movie event.
     *
     * @param  int  $id
     * @param  int  $room
     */
    public function addSeats($id, $room)
    {
        if ($room == '1')
            MovieSeat::insert([
                [ #1
                    'movie_id' => $id,
                    'seat_id' => '1',
                    'available' => '1'
                ],
                [ #2
                    'movie_id' => $id,
                    'seat_id' => '2',
                    'available' => '1'
                ],
                [ #3
                    'movie_id' => $id,
                    'seat_id' => '3',
                    'available' => '1'
                ],
                [ #4
                    'movie_id' => $id,
                    'seat_id' => '4',
                    'available' => '1'
                ],
                [ #5
                    'movie_id' => $id,
                    'seat_id' => '5',
                    'available' => '1'
                ],
                [ #6
                    'movie_id' => $id,
                    'seat_id' => '6',
                    'available' => '1'
                ],
                [ #7
                    'movie_id' => $id,
                    'seat_id' => '7',
                    'available' => '1'
                ],
                [ #8
                    'movie_id' => $id,
                    'seat_id' => '8',
                    'available' => '1'
                ],
                [ #9
                    'movie_id' => $id,
                    'seat_id' => '9',
                    'available' => '1'
                ],
                [ #10
                    'movie_id' => $id,
                    'seat_id' => '10',
                    'available' => '1'
                ],
                [ #11
                    'movie_id' => $id,
                    'seat_id' => '11',
                    'available' => '1'
                ],
                [ #12
                    'movie_id' => $id,
                    'seat_id' => '12',
                    'available' => '1'
                ],
                [ #13
                    'movie_id' => $id,
                    'seat_id' => '13',
                    'available' => '1'
                ],
                [ #14
                    'movie_id' => $id,
                    'seat_id' => '14',
                    'available' => '1'
                ],
                [ #15
                    'movie_id' => $id,
                    'seat_id' => '15',
                    'available' => '1'
                ],
                [ #16
                    'movie_id' => $id,
                    'seat_id' => '16',
                    'available' => '1'
                ],
                [ #17
                    'movie_id' => $id,
                    'seat_id' => '17',
                    'available' => '1'
                ],
                [ #18
                    'movie_id' => $id,
                    'seat_id' => '18',
                    'available' => '1'
                ],
                [ #19
                    'movie_id' => $id,
                    'seat_id' => '19',
                    'available' => '1'
                ],
                [ #20
                    'movie_id' => $id,
                    'seat_id' => '20',
                    'available' => '1'
                ]
            ]);
        else
            MovieSeat::insert([
                [ #1
                    'movie_id' => $id,
                    'seat_id' => '21',
                    'available' => '1'
                ],
                [ #2
                    'movie_id' => $id,
                    'seat_id' => '22',
                    'available' => '1'
                ],
                [ #3
                    'movie_id' => $id,
                    'seat_id' => '23',
                    'available' => '1'
                ],
                [ #4
                    'movie_id' => $id,
                    'seat_id' => '24',
                    'available' => '1'
                ],
                [ #5
                    'movie_id' => $id,
                    'seat_id' => '25',
                    'available' => '1'
                ],
                [ #6
                    'movie_id' => $id,
                    'seat_id' => '26',
                    'available' => '1'
                ],
                [ #7
                    'movie_id' => $id,
                    'seat_id' => '27',
                    'available' => '1'
                ],
                [ #8
                    'movie_id' => $id,
                    'seat_id' => '28',
                    'available' => '1'
                ],
                [ #9
                    'movie_id' => $id,
                    'seat_id' => '29',
                    'available' => '1'
                ],
                [ #10
                    'movie_id' => $id,
                    'seat_id' => '30',
                    'available' => '1'
                ],
                [ #11
                    'movie_id' => $id,
                    'seat_id' => '31',
                    'available' => '1'
                ],
                [ #12
                    'movie_id' => $id,
                    'seat_id' => '32',
                    'available' => '1'
                ],
                [ #13
                    'movie_id' => $id,
                    'seat_id' => '33',
                    'available' => '1'
                ],
                [ #14
                    'movie_id' => $id,
                    'seat_id' => '34',
                    'available' => '1'
                ],
                [ #15
                    'movie_id' => $id,
                    'seat_id' => '35',
                    'available' => '1'
                ],
                [ #16
                    'movie_id' => $id,
                    'seat_id' => '36',
                    'available' => '1'
                ],
                [ #17
                    'movie_id' => $id,
                    'seat_id' => '37',
                    'available' => '1'
                ],
                [ #18
                    'movie_id' => $id,
                    'seat_id' => '38',
                    'available' => '1'
                ],
                [ #19
                    'movie_id' => $id,
                    'seat_id' => '39',
                    'available' => '1'
                ],
                [ #20
                    'movie_id' => $id,
                    'seat_id' => '40',
                    'available' => '1'
                ],
                [ #21
                    'movie_id' => $id,
                    'seat_id' => '41',
                    'available' => '1'
                ],
                [ #22
                    'movie_id' => $id,
                    'seat_id' => '42',
                    'available' => '1'
                ],
                [ #23
                    'movie_id' => $id,
                    'seat_id' => '43',
                    'available' => '1'
                ],
                [ #24
                    'movie_id' => $id,
                    'seat_id' => '44',
                    'available' => '1'
                ],
                [ #25
                    'movie_id' => $id,
                    'seat_id' => '45',
                    'available' => '1'
                ],
                [ #26
                    'movie_id' => $id,
                    'seat_id' => '46',
                    'available' => '1'
                ],
                [ #27
                    'movie_id' => $id,
                    'seat_id' => '47',
                    'available' => '1'
                ],
                [ #28
                    'movie_id' => $id,
                    'seat_id' => '48',
                    'available' => '1'
                ],
                [ #29
                    'movie_id' => $id,
                    'seat_id' => '49',
                    'available' => '1'
                ],
                [ #30
                    'movie_id' => $id,
                    'seat_id' => '50',
                    'available' => '1'
                ],
            ]);
    }
}
