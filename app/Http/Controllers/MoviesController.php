<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

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
            'poster' => 'required|string|max:255' ,
        ]);
        
        if ($validator->fails()) {
            return response()->json(['message' => 'Something went wrong',$validator->getMessageBag()], 400);
        } else {
            $movie = Movie::create([
                'title' => $request->title,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'screen' => $request->screen,
                'poster' => $request->poster,
            ]);

            
            return response()->json(['message' => 'Successfully added the movie'], 201);
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
            'date' => 'date|after:yesterday',
            'start_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i|after:start_time',
            'screen' => 'integer|in:1,2',
            'poster' => 'string|max:255' ,
        ]);
        
        if ($validator->fails()) {
            return response()->json(['message' => 'Something went wrong',$validator->getMessageBag()], 400);
        } else {
            $movie = Movie::findOrFail($id);
            //print ($request -> title);
            $movie->title = $request->title;
            $movie->date = $request->date;
            $movie->start_time = $request->start_time;
            $movie->end_time = $request->end_time;
            $movie->screen = $request->screen;
            $movie->poster = $request->poster;
            $movie->updated_date = now();
            //print($movie);
            $movie -> save();
            return response()->json(['message' => 'Successfully updated the movie'], 201);
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
}
