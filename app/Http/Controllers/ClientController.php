<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Http\Resources\Client as  ClientResource;
use Illuminate\Http\Request;

use Validator;

class ClientController extends Controller
{
   public function model()
    {
        return Client::class;
    }

    public  function index()
    {
        return response()->json(Client::get(),200);
    }

    public  function show($id)
    {
        $client=Client::find($id);
        if(is_null($client))
        {
            return response()->json(null,404);

        }

        $response=new ClientResource(Client::findOrFail($id),200);
        return response()->json($response,200);
    }

    public  function store(Request $request)
    {
        $rules=[
            'client_type'=>'required',
            'name'=>'required',
            'email'=>['email','unique:clients,email'],
            'sector_id' => 'required',
            'vendor_status'=>'required',
            'contact_person' =>'required',
            'mobile' =>'required',
            'bdm_person' =>'required'
        ];
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

       
        $client=Client::create([
            'name' => request('name'),
            'email' => request('email'),
            'client_type' => request('client_type'),
            'sector_id' => request('sector_id'),
            'vendor_status' => request('vendor_status'),
            'contact_person' => request('contact_person'),
            'mobile'       => request('mobile'),
            'work_phone'       => request('work_phone'),
            'bdm_person'       => request('bdm_person'),
            'address'          => request('address')

        ]);
        return response()->json(['message' => 'Client added succesfully','data'=>$client], 200);


    }

    public  function delete(Request $request, Client $client)
    {
        $client->delete();
        return response()->json(null,204);

    }

    public  function errors()
    {
        return response()->json(["message"=>"Error occurred"],501);

    }
}
