<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

/*
* Create a new admin user in case he does not exist
* to enable us create tokens or use tokens for authentication
*/
Route::get('/setup', function(){
    $credentials = [
        'email'=>'admin@admin.com',
        'password'=>'password'
    ];

    if(!Auth::attempt($credentials)) {
        $user = new \App\Models\User; 
        $user->name = 'Admin'; 
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->save();

        //sign in with the newly created user
        if(Auth::attempt($credentials)){
            $user = Auth::user();

            //create new tokens
            $adminToken = $user->createToken('admin-token', ['create','update','delete']);
            $updateToken = $user->createToken('update-token', ['create','update']);
            $basicToken = $user->createToken('basic-token'); //read only token

            return [
                'admin'=> $adminToken->plainTextToken,
                'update'=> $updateToken->plainTextToken,
                'basic'=> $basicToken->plainTextToken,
            ];
        }
    }
    
});