<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $output = [];
        $reservations = DB::table('reservations')
            ->where('user_id', '=', $request->user()->id)
            ->get();

        
        foreach($reservations as $reservation){
            $movieId=$reservation->movie_id;
            $movie = DB::table('movies')->where('id', '=', $movieId)
            ->get();
            $seatsIds=DB::table('movie_seats')->where('reservation_id', '=', $reservation->id)
            ->get();
            $seats=[];
            foreach($seatsIds as $seatsId){
                $seat=DB::table('seats')->where('id', '=', $seatsId->seat_id)
                ->get();
                array_push($seats,['row'=>$seat[0]->row_number,'column'=>$seat[0]->column_number,]);
            }
            $output[] = [
                'id'=>$reservation->id,
                'movie_id'=> $movieId,
                'movieTitle'=> $movie[0]->title,
                'room'=> $movie[0]->screen,
                'creation_date'=>$reservation->creation_date,
                'seats'=>$seats,
            ];
        } 
        return $output;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //


        $validator = Validator()->make($request->all(), [
            "seats"    => "required|array",
            "seats.*"  => "required|integer",
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Something went wrong', $validator->getMessageBag()], 400);
        } else {
            foreach ($request->seats as $seatId) {
                $reservation =    DB::table('movie_seats')
                    ->where('movie_id', $id)
                    ->where('seat_id', $seatId)->where('reservation_id','!=',null)->first();
                if($reservation){
                    return response()->json(['message' => 'Sorry Seat(s) is already taken try another seats'], 403);
                }    
            }

            $reservation = Reservation::create([
                'user_id' => $request->user()->id,
                'movie_id' => $id,
            ]);


            //$this->addSeats($movie->id, $request->screen);
            $this->reserve($reservation->id, $id, $request->seats);

            return response()->json(['message' => 'Successfully added the reservation'], 201);
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
        /* $dates = DB::table('movie_seats')
            ->where('reservation_id', '=', $id)
            ->join('movies', 'movie_seats.movie_id', '=', 'movies.id')
            ->select('movies.date', 'movies.start_time')
            ->get();
        $time_new = Carbon::createFromFormat('Y/m/d H:i:s', now()); */
        //$time_old = Carbon::createFromFormat('Y/m/d H:i:s', );
        $condition = false;
        if ($condition) {
            //echo $dates[0]->start_time . " " . $dates[0]->date;
            return response()->json(['message' => 'Sorry! The customer can cancel a reserved ticket only 3 hours
            before the start of the event'], 400);
        } else {
            DB::table('movie_seats')
                ->where('reservation_id', $id)
                ->update(['reservation_id' => NULL, 'available' => 1]);
            DB::table('reservations')
                ->where('id', $id)
                ->delete();
            return response()->json(['message' => 'Successfully deleted the reservation'], 201);
        }
    }

    public function reserve($reservation, $movie_id, $ids)
    {
        //
        foreach ($ids as $id) {
            DB::table('movie_seats')
                ->where('movie_id', $movie_id)
                ->where('seat_id', $id)
                ->update(['reservation_id' => $reservation, 'available' => 0]);
        }
        //echo $id ."\n";
    }
}
