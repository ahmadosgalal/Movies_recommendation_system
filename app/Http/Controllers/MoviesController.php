<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\File;

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
            'poster' => 'required' ,
        ]);
        
        if ($validator->fails()) {
            return response()->json(['message' => 'Something went wrong','ErrorsIn'=>$validator->getMessageBag()], 400);
        } else {

            $movie = Movie::create([
                'title' => $request->title,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'screen' => $request->screen,
                'poster' => '',
            ]);
            $Image=$request->file('poster');
            $ImageName='/movie_poster_'.$movie->id.'.'.$Image->getClientOriginalExtension();
            $path=$request->file('poster')->move(public_path('/imgs/movies_posters'),$ImageName);
            $PhotoUrl='/imgs/movies_posters'.$ImageName;
            $movie->poster= $PhotoUrl;
            $movie->save();
            
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
            'date' => 'required|date|after:yesterday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'screen' => 'required|integer|in:1,2',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['message' => 'Something went wrong','ErrorsIn'=>$validator->getMessageBag()], 400);
        } else {
            $movie = Movie::findOrFail($id);
            if($movie){
                //delete the image first..
                if($request->file('poster')!=null ){
                    $poster_image=$movie->poster;
                    $imagepath=public_path().$poster_image;
                    if($imagepath){
                    File::delete($imagepath);}
                    else{
                        $movie->poster=''; 
                    }
                    //then update with the new poster..
                    $Image=$request->file('poster');
                    $ImageName='/movie_poster_'.$movie->id.'.'.$Image->getClientOriginalExtension();
                    $path=$request->file('poster')->move(public_path('/imgs/movies_posters'),$ImageName);
                    $PhotoUrl='/imgs/movies_posters'.$ImageName;
                    $movie->poster= $PhotoUrl;
                }
                //print ($request -> title);
                $movie->title = $request->title;
                $movie->date = $request->date;
                $movie->start_time = $request->start_time;
                $movie->end_time = $request->end_time;
                $movie->screen = $request->screen;
                $movie->updated_date = now();
                //print($movie);
                $movie -> save();

                return response()->json(['message' => 'Successfully updated the movie'], 201);}
            else{
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
}
