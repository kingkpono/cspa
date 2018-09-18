<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesTicket;
use App\Http\Resources\SalesTicket as  SalesTicketResource;


use Validator;

class SalesTicketController extends Controller
{
    
    public  function index()
    {
        return response()->json(SalesTicket::get(),200);
    }

    public  function show($id)
    {
        $salesTicket=SalesTicket::find($id);
        if(is_null($salesTicket))
        {
            return response()->json(null,404);

        }

        $response=new SalesTicketResource(SalesTicket::findOrFail($id)->with('client')->with('serviceType')->get(),200);
        return response()->json($response,200);
    }

    public  function store(Request $request)
    {

        
        $rules=[
         
            'client_id'=>'required',
            'service_type_id'=>'required',
            'project_details'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'project_officers'=>'required',
            'ticket_contact_email'=>['required_without:ticket_contact_phone','email'],
            'ticket_contact_phone'=>'required_without:ticket_contact_email'
        ];
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
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
            'project_officers' => request('project_officers'), 
            'attachment' =>  request('attachment')

        ]);
        return response()->json(['message' => 'Sales Ticket added successfully','data'=>$salesTicket], 200);


    }

    public  function update(Request $request, SalesTicket $salesTicket)
    {
        $salesTicket->update($request->all());
        return response()->json($salesTicket,200);

    }


    public  function delete(Request $request, SalesTicket $salesTicket)
    {
        $salesTicket->delete();
        return response()->json(null,204);

    }

    public  function errors()
    {
        return response()->json(["message"=>"Error occurred"],501);

    }
}
