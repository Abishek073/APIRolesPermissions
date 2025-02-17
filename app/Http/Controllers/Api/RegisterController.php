<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\RegisterRequest;
use Spatie\Permission\Models\Role;


class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        //register user
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password)
        ]);

        //assign role
        $user_role = Role::where(['name'=> 'user']) ->first();
        if($user_role){
            $user->assignRole($user_role);
        }
        
      
       //send response
       return new UserResource($user);
    }
}
