<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicketRemark;
use App\Http\Resources\SupportTicketRemark as  SupportTicketRemarkResource;


use Validator;

class SupportTicketRemarkController extends Controller
{
    
    public  function index($supportTicketId)
    {
        return response()->json(SupportTicketRemark::select('*')->where('support_ticket_id',$supportTicketId)->with('user')->with('support_ticket_id')->get(),200);
    }

    public  function show($id)
    {
        $supportTicketRemark=SupportTicketRemark::find($id);
        if(is_null($supportTicketRemark))
        {
            return response()->json(null,404);

        }

        $response=new SupportTicketRemarkResource(SupportTicketRemark::findOrFail($id)->with('user')->with('support_ticket_id')->get(),200);
        return response()->json($response,200);
    }

    public  function store(Request $request)
    {
        $rules=[
            'user_id'=>'required',
        'support_ticket_id'=>'required',
         'remark'=>'required'  
             
        ];
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

       
        $supportTicketRemark=SupportTicketRemark::create([
            'user_id' => request('user_id'),
            'support_ticket_id' => request('support_ticket_id'),
            'remark' => request('remark')        

        ]);
        return response()->json(['message' => 'Support Ticket Remark added successfully','data'=>$supportTicketRemark], 200);


    }

    


    public  function errors()
    {
        return response()->json(["message"=>"Error occurred"],501);

    }
}
