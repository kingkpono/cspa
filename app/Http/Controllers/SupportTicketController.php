<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Http\Resources\SupportTicket as  SupportTicketResource;


use Validator;

class SupportTicketController extends Controller
{
    
    public  function index()
    {
        return response()->json(SupportTicket::with('client')->with('serviceType')->with('officer1')->with('officer2')->with('officer3')->get(),200);
    }

    public  function show($id)
    {
        $supportTicket=SupportTicket::find($id);
        if(is_null($supportTicket))
        {
            return response()->json(null,404);

        }

        $response=new SupportTicketResource(SupportTicket::findOrFail($id)->with('client')->with('serviceType')->with('officer1')->with('officer2')->with('officer3')->get(),200);
        return response()->json($response,200);
    }
    
    public  function getTicketsByUserId($id)
    {
        $supportTickets=SupportTicket::with('client')->with('serviceType')->with('officer1')->with('officer2')->with('officer3')->whereRaw('officer1='.$id.' OR officer2='.$id.' OR officer3='.$id)->get();

        if(is_null($supportTickets))
        {
            return response()->json(null,404);

        }

        
        return response()->json($supportTickets,200);
    }

  
    public  function store(Request $request)
    {

        
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
        return response()->json(['message' => 'Support Ticket added successfully','data'=>$supportTicket], 200);


    }

    public  function update(Request $request, SupportTicket $supportTicket)
    {
        


        $supportTicket->update($request->all());
         
      
        return response()->json($supportTicket,200);

    }


    public  function delete(Request $request, SupportTicket $supportTicket)
    {
        DB::table('support_tickets')
             ->where('id', $request->id)->delete();
                return response()->json(null,204);
        

    }

    public  function errors()
    {
        return response()->json(["message"=>"Error occurred"],501);

    }
}
