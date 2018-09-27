<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CassObject;
use App\Models\CassType;
use App\Http\Resources\CassObject as  CassObjectResource;
use Illuminate\Support\Facades\DB;


use Validator;

class CassObjectController extends Controller
{
    
    public  function index()
    {
        return response()->json(CassObject::with('client')->with('serviceType')->with('cassType')->with('user')->get(),200);
    }

    public  function getDue(Request $request)
    {

         
        $rules=[
      
            'due_month'=>'required',
            'due_year'=>'required'
          
        ];
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return $this->error($validator->errors(),400);
        }
        return response()->json(CassObject::where('due_year', '<=', $request->due_year)
        ->where('due_month', '<=', $request->due_month)->with('client')->with('serviceType')->with('cassType')->with('user')->get(),200);
    }

 

    public  function show($id)
    {
        $cassObject=CassObject::find($id);
        if(is_null($cassObject))
        {
            return response()->json(null,404);

        }

        $response=new CassObjectResource(CassObject::findOrFail($id)->with('client')->with('serviceType')->with('cassType')->with('user')->get(),200);
        return response()->json($response,200);
    }

    public  function getCassTypes()
    {
        return response()->json(CassType::get(),200);

    }

    public  function store(Request $request)
    {

        
        $rules=[
         
            'client_id'=>'required',
            'service_type_id'=>'required',
            'cass_type_id'=>'required',
            'due_month'=>'required',
            'due_year'=>'required',
            'location'=>'required',
            'remark'=>'required'
        ];
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        

       
            $cassObject=CassObject::create([
                'client_id'=>request('client_id'),
                'service_type_id'=>request('service_type_id'),
                'cass_type_id'=>request('cass_type_id'),
                'due_month'=>request('due_month'),
                'due_year'=>request('due_year'),
                'location'=>request('location'),
                'remark'=>request('remark'),
                'user_id'=>request('user_id')

        ]);
        return response()->json(['message' => 'Client Cass added successfully','data'=>$cassObject], 200);


    }

    public  function update(Request $request, CassObject $cassObject)
    {
        $cassObject->update($request->all());
        return response()->json($cassObject,200);

    }


    public  function delete(Request $request, CassObject $cassObject)
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
