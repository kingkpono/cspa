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
        return response()->json(Client::with('bdmperson')->with('sector')->get(),200);
    }
    
    public  function getClientsByBdmId($id)
    {    
        return response()->json(Client::where('bdm_person_id', $id)->with('bdmperson')->with('sector')->get(),200);
    }
    
    public  function prospects()
    {
        return response()->json(Client::where('client_type','prospect')->with('bdmperson')->with('sector')->get(),200);
    }

    public  function show($id)
    {
        $client=Client::find($id);
        if(is_null($client))
        {
            return response()->json(null,404);

        }

        $response=new ClientResource(Client::findOrFail($id)->with('bdmperson')->with('sector')->get(),200);
        return response()->json($response,200);
    }

    public  function showProspect($id)
    {
        $client=Client::find($id);
        if(is_null($client))
        {
            return response()->json(null,404);

        }

        $response=new ClientResource(Client::findOrFail($id)->where('client_type','prospect')->with('bdmperson')->with('sector')->get(),200);
        return response()->json($response,200);
    }

    public  function store(Request $request)
    {
        $rules=[
            'client_type'=>'required',
            'name'=>'required',
            'email'=>['required','unique:clients,email'],
            'sector_id' => 'required|numeric',
            'vendor_status'=>'required',
            'contact_person' =>'required',
            'mobile' =>'required_without:work_phone',
            'work_phone' =>'required_without:mobile',
            'bdm_person_id' =>'required|numeric',
            'address' =>'required',
            'address' =>'required'

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
            'bdm_person_id'       => request('bdm_person_id'),
            'address'          => request('address')

        ]);
        return response()->json(['message' => 'Client added succesfully','data'=>$client], 200);


    }

    public  function delete(Request $request, Client $client)
    {
        $client->delete();
        return response()->json(null,204);

    }
    
    public  function update(Request $request, Client $client)
    {
        $client->update($request->all());
        echo $client->toSql();
        return response()->json($client,200);

    }

    public  function errors()
    {
        return response()->json(["message"=>"Error occurred"],501);

    }
}
