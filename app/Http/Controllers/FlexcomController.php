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

    public  function storeTicket(Request $request)
    {

   //first create a support ticket
         
        $rules=[
         
            'client_id'=>'required',
            'service_type_id'=>'required',
            'project_details'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'project_officers'=>'required'
        ];
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

       
       
            $supportTicket=SupportTicket::create([
            'client_id' => request('client_id'),
            'service_type_id' => request('service_type_id'),     
            'description' => request('description'),   
            'project_details' => request('project_details'), 
            'start_date' => request('start_date'), 
            'end_date' => request('end_date'), 
            'status' => 'Pending', 
            'project_officers' => request('project_officers'), 
            'attachment' =>  request('attachment')

        ]);

         //then create a flexcom create a support ticket
         if($supportTicket)
         {
          $rules=[
           
            'support_ticket_id'=>'required',
            'issue_type'=>'required',
            'mobile_numbers'=>'required'

           ];
          try{
            $validator=Validator::make($request->all(),$rules);

             if($validator->fails()){
            return $this->error($validator->errors(),400);
           }
        
       
           $flexTicket=FlexcomTicket::create([
            'support_ticket_id' => $client->id,
            'issue_type' => request('issue_type'),
            'mobile_numbers' => request('mobile_numbers')      

            ]);
             return response()->json(['message' => 'Flexcom ticket added successfully','data'=>$client], 200);
            } catch (\Exception $error) {
              return response()->json('Error creating flexcom ticket', 501);
             }
            }//end if support ticket 
            else{
                return response()->json('Error creating flexcom ticket', 501);

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
