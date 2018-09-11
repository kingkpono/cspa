<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceType;
use App\Http\Resources\ServiceType as  ServiceTypeResource;


use Validator;

class ServiceTypeController extends Controller
{
    
    public  function index()
    {
        return response()->json(ServiceType::get(),200);
    }

    public  function show($id)
    {
        $serviceType=ServiceType::find($id);
        if(is_null($serviceType))
        {
            return response()->json(null,404);

        }

        $response=new ServiceTypeResource(ServiceType::findOrFail($id),200);
        return response()->json($response,200);
    }

    public  function store(Request $request)
    {
        $rules=[
         
            'service_type'=>'required',
            'description'=>'required'

             
        ];
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

       
        $serviceType=ServiceType::create([
            'service_type' => request('service_type'),
            'description' => request('description')          

        ]);
        return response()->json(['message' => 'Service type added successfully','data'=>$serviceType], 200);


    }

    public  function update(Request $request, ServiceType $serviceType)
    {
        $serviceType->update($request->all());
        return response()->json($serviceType,200);

    }


    public  function delete(Request $request, ServiceType $serviceType)
    {
        $serviceType->delete();
        return response()->json(null,204);

    }

    public  function errors()
    {
        return response()->json(["message"=>"Error occurred"],501);

    }
}
