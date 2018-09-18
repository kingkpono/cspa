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
        return response()->json(SupportTicket::with('client')->with('serviceType')->get(),200);
    }

    public  function show($id)
    {
        $supportTicket=SupportTicket::find($id);
        if(is_null($supportTicket))
        {
            return response()->json(null,404);

        }

        $response=new SupportTicketResource(SupportTicket::findOrFail($id)->with('client')->with('serviceType')->get(),200);
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
