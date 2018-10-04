<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesTicket;
use App\Http\Resources\SalesTicket as  SalesTicketResource;
use Illuminate\Support\Facades\DB;


use Validator;

class SalesTicketController extends Controller
{
    
    public  function index()
    {
        return response()->json(SalesTicket::with('client')->with('serviceType')->with('officer1')->with('officer2')->with('officer3')->get(),200);
    }

    public  function show($id)
    {
        $salesTicket=SalesTicket::find($id);
        if(is_null($salesTicket))
        {
            return response()->json(null,404);

        }

        $response=new SalesTicketResource(SalesTicket::findOrFail($id)->with('client')->with('serviceType')->with('officer1')->with('officer2')->with('officer3')->get(),200);
        return response()->json($response,200);
    }

    public  function getTicketsByUserId($id)
    {
        $salesTickets=SalesTicket::with('client')->with('serviceType')->with('officer1')->with('officer2')->with('officer3')->whereRaw('officer1='.$id.' OR officer2='.$id.' OR officer3='.$id)->get();
        
        if(is_null($salesTickets))
        {
            return response()->json(null,404);

        }

        
        
        return response()->json( $salesTickets,200);
    }

    public  function store(Request $request)
    {

        
        $rules=[
         
            'client_id'=>'required',
            'service_type_id'=>'required',
            'project_details'=>'required',
            'project_officers'=>'required',
            'ticket_contact_email'=>['required_without:ticket_contact_phone','email'],
            'ticket_contact_phone'=>'required_without:ticket_contact_email'
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
    
       
            $salesTicket=SalesTicket::create([
            'client_id' => request('client_id'),
            'service_type_id' => request('service_type_id'),    
            'device' => request('device'),  
            'serial_number' => request('serial_number'),  
            'device_description' => request('device_description'),   
            'device_warranty' => request('device_warranty'), 
            'project_details' => request('project_details'), 
            'ticket_contact_email'=>request('ticket_contact_email'), 
            'ticket_contact_phone'=>request('ticket_contact_phone'), 
            'start_date' => request('start_date'), 
            'end_date' => request('end_date'), 
            'status' => 'Pending', 
            'officer1' => $officer1, 
            'officer2' => $officer2, 
            'officer3' => $officer3, 
            'attachment' =>  request('attachment')

        ]);
        return response()->json(['message' => 'Sales Ticket added successfully','data'=>$salesTicket], 200);


    }

    public  function update(Request $request, SalesTicket $salesTicket)
    {
        
      if(request('project_officers')!=null || request('project_officers')=='')
      {
           echo "In";
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

         
         $request->input('officer1', $officer1);
         $request->input('officer2', $officer2);
         $request->input('officer3', $officer3);
    
        }
        
        var_dump($request->all());
        die;
        $salesTicket->update($request->all());
        return response()->json($salesTicket,200);

    }


    public  function delete(Request $request, SalesTicket $salesTicket)
    {
   

        DB::table('sales_tickets')
             ->where('id', $request->id)->delete();
                    return response()->json(null,204);

    }

    public  function errors()
    {
        return response()->json(["message"=>"Error occurred"],501);

    }
}
