<?php

namespace App\Http\Controllers;
use App\Models\Auth\User;
use App\Http\Resources\User as  UserResource;
use Illuminate\Http\Request;
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
            return response()->json($validator->errors(),400);
        }
        $user=User::create($request->all());
        return response()->json($user,201);

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

    public  function errors()
    {
        return response()->json(["msg"=>"Error occurred"],501);

    }
}
