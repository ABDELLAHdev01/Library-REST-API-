<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // show user information from the database using auth jwt token
        $user = auth()->user();
        return response()->json($user, 200);

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
    public function show()
    {
       // show user onformation from the database using auth jwt token
        $user = auth()->user();
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // update user information from the database using auth jwt token
        $User = User::find(auth()->user()->id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $User->name = "$request->name";
        $User->email = "$request->email";
        
        $User->save();


        return response()->json($User, 200);

    }


    public function updatePassword(Request $request)
    {
        // update user password from the database using auth jwt token
        $User = User::find(auth()->user()->id);
        $request->validate([
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6',
            'old_password' => 'required|string|min:6',
        ]);

        if($request->password != $request->password_confirmation){
            return response()->json([
                'status' => 'error',
                'message' => 'Password confirmation does not match',
            ], 401);
        }
        if(!Hash::check($request->old_password, $User->password)){
            return response()->json([
                'status' => 'error',
                'message' => 'Old password does not match',
            ], 401);
        }
        if(Hash::check($request->password, $User->password)){
            return response()->json([
                'status' => 'error',
                'message' => 'New password cannot be the same as old password',
            ], 401);
        }
        

    
        
        $User->password = Hash::make($request->password);
        $User->save();
    
    
            return response()->json("$User->name your password has been updated", 200);
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        User::destroy(auth()->user()->id);
        return response()->json('User deleted', 200);
    }
}
