<?php

namespace App\Http\Controllers;
use App\Models\Auth\User;
use App\Http\Resources\User as  UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;

class UsersController extends Controller
{

   
    public  function index()
    {
        return response()->json(User::get(),200);
    }

    public  function show($id)
    {
        $user=User::find($id);
        if(is_null($user))
        {
            return response()->json(null,404);

        }

        $response=new UserResource(User::findOrFail($id),200);
        return response()->json($response,200);
    }

    public  function store(Request $request)
    {
        $rules=[
            'name'=>'required',
            'email'=>['email','unique:users,email'],
            'password' => 'required'
        ];
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return $this->error($validator->errors(),400);
            
        }

        try{
        $user=User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'department' => request('department'),
            'phone' => request('phone'),
            'role'       => request('role')
        ]);
        return response()->json(['message' => 'Staff added successfully','data'=>$user], 200);
         } catch (\Exception $error) {
            return response()->json(["message"=>"Error creating client"], 501);
        }

    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){



        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $user->api_token = str_random(60);
            $user->save();
            return response()->json(['message' => 'Login successful','token'=>$user->api_token,'data'=>$user], 200);
        }
        else{
            return response()->json(['message'=>'Login failed'], 401);
            
        }
    }


public  function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user,200);

    }

    public  function delete(Request $request, User $user)
    {
        $user->delete();
        return response()->json(null,204);

    }

   
}
