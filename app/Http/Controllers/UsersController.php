<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$users = User::all();
        $users = User::where('manager_request', '=', '1')->get();
        return $users;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UserIndex()
    {
        //
        $registeredUser=Auth::user();
        $users = User::where('id', '!=', $registeredUser->id)->get();
        return $users;
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
    public function store(Request $request)
    {
        //
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
        $user = User::find($id);
        if($user){
            $validator = Validator()->make($request->all(), [
                'approved' => 'required' ,
            ]);
    
            if ($validator->fails()) {
                return response()->json(['message' => 'Something went wrong','ErrorsIn'=>$validator->getMessageBag()], 400);
            } else {

                if($request->approved == 1 && $user->manager_request == 1)
                {
                    $user->role = 'Manager';
                }
                $user->manager_request = 0;
                $user->save();

                return response()->json(['message' => 'Successfully responded to request'], 200);}
        }
        else{
            return response()->json(['message' => 'No such user'], 404);
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
        $user = User::find($id);
        if($user){
            $user -> delete();
            return response()->json(['message' => 'Successfully deleted the user'], 200);
        }
        else{
            return response()->json(['message' => 'No such user'], 404);
        }    
        
    }
}
