<?php

namespace App\Http\Controllers;
use App\Models\FlexcomClient;
use App\Models\FlexcomTicket;
use App\Models\SupportTicket;
use App\Http\Resources\FlexcomClient as  FlexcomClientResource;
use App\Http\Resources\FlexcomTicket as  FlexcomTicketResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use Validator;


class FlexcomClientController extends Controller
{
   public function model()
    {
        return FlexcomClient::class;
    }

    public  function getClients()
    {
        return response()->json(FlexcomClient::with('client')->get(),200);
    }

  
    public  function getTickets()
    {
        return response()->json(FlexcomTicket::with('supportTicket')->get(),200);
    }

   
    

    public  function getClient($id)
    {
        $client=FlexcomClient::find($id);
        if(is_null($client))
        {
            return response()->json(null,404);

        }

        $response=new FlexcomClientResource(FlexcomClient::findOrFail($id)->with('client')->get(),200);
        return response()->json($response,200);
    }

    
    public  function getTicket($id)
    {
        $ticket=FlexcomTicket::find($id);
        if(is_null($ticket))
        {
            return response()->json(null,404);

        }

        $response=new FlexcomTicketResource(FlexcomTicket::findOrFail($id)->with('supportTicket')->get(),200);
        return response()->json($response,200);
    }

    public  function store(Request $request)
    {
        $rules=[
            'client_type'=>'required',
            'name'=>'required'

        ];
        try{
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return $this->error($validator->errors(),400);
        }
        
       
        $client=FlexcomClient::create([
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
        return response()->json(['message' => 'FlexcomClient added successfully','data'=>$client], 200);
    } catch (\Exception $error) {
        return response()->json('Error creating client', 501);
    }

    }

    public  function delete(Request $request, FlexcomClient $client)
    {
        $client->delete();
        return response()->json(null,204);

    }
    
    public  function update(Request $request, FlexcomClient $client)
    {
        $client->update($request->all());
     
        return response()->json($client,200);

    }

   

    
}
