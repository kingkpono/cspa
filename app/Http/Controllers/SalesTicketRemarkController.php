<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesTicketRemark;
use App\Http\Resources\SalesTicketRemark as  SalesTicketRemarkResource;


use Validator;

class SalesTicketRemarkController extends Controller
{
    
    public  function index($salesTicketId)
    {
        return response()->json(SalesTicketRemark::select('*')->where('sales_ticket_id',$salesTicketId)->with('user')->with('salesTicket')->get(),200);
    }

    public  function show($id)
    {
        $salesTicketRemark=SalesTicketRemark::find($id);
        if(is_null($salesTicketRemark))
        {
            return response()->json(null,404);

        }

        $response=new SalesTicketRemarkResource(SalesTicketRemark::findOrFail($id)->with('user')->with('sales_ticket_id')->get(),200);
        return response()->json($response,200);
    }

    public  function store(Request $request)
    {
        $rules=[
            'user_id'=>'required',
        'sales_ticket_id'=>'required',
         'remark'=>'required'  
             
        ];
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

       
        $salesTicketRemark=SalesTicketRemark::create([
            'user_id' => request('user_id'),
            'sales_ticket_id' => request('sales_ticket_id'),
            'remark' => request('remark')        

        ]);
        return response()->json(['message' => 'Sales Ticket Remark added successfully','data'=>$salesTicketRemark], 200);


    }

    


    public  function errors()
    {
        return response()->json(["message"=>"Error occurred"],501);

    }
}
