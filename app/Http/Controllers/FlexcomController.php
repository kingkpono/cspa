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


class FlexcomController extends Controller
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

       
        $officers=explode(',',request('project_officers'));

       
        $officersCount=count($officers);
         $officer1=0;
         $officer2=0;
         $officer3=0;
        
         if($officersCount==1)
         {
            $officer1=$officers[0];
            $officer2=$officers[0];
            $officer3=$officers[0];
         }else if($officersCount==2)
         {
            $officer1=$officers[0];
            $officer2=$officers[1];
            $officer3=$officers[1];
         }
         else if($officersCount==3)
         {
            $officer1=$officers[0];
            $officer2=$officers[1];
            $officer3=$officers[2];
         }
    
       
       
            $supportTicket=SupportTicket::create([
            'client_id' => request('client_id'),
            'service_type_id' => request('service_type_id'),     
            'description' => request('description'),   
            'project_details' => request('project_details'), 
            'start_date' => request('start_date'), 
            'end_date' => request('end_date'), 
            'status' => 'Pending', 
            'officer1' => $officer1, 
            'officer2' => $officer2, 
            'officer3' => $officer3, 
            'attachment' =>  request('attachment')

        ]);

         //then create a flexcom create a support ticket
         if($supportTicket)
         {
          $rules=[
           
            'issue_type'=>'required',
            'mobile_numbers'=>'required'

           ];
           try{
            $validator=Validator::make($request->all(),$rules);

             if($validator->fails()){
            return $this->error($validator->errors(),400);
           }
     
         
           $flexTicket=FlexcomTicket::create([
            'support_ticket_id' =>  $supportTicket->id,
            'issue_type' => request('issue_type'),
            'mobile_numbers' => request('mobile_numbers')      

            ]);
             return response()->json(['message' => 'Flexcom ticket added successfully','data'=>$flexTicket], 200);
            } catch (\Exception $error) {
              return response()->json(['message' => 'Error creating flexcom ticket'], 501);
             }
            }//end if support ticket 
            else{
                return response()->json('Error creating flexcom ticket', 501);

            }    

    }
    public  function storeClient(Request $request)
    {

       
           $rules=[
         
            'client_id'=>'required',
           
           ];
           try{
            $validator=Validator::make($request->all(),$rules);

             if($validator->fails()){
            return $this->error($validator->errors(),400);
             }
     
           $flexClient=FlexcomClient::create([
            'client_id' => request('client_id')]);
             return response()->json(['message' => 'Flexcom client added successfully','data'=> $flexClient], 200);
            } catch (\Exception $error) {
              return response()->json(['message' => 'Error creating flexcom  client'], 501);
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
