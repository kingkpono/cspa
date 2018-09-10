<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Http\Resources\Device as  DeviceResource;


use Validator;

class DeviceController extends Controller
{
    
    public  function index()
    {
        return response()->json(Device::get(),200);
    }

    public  function show($id)
    {
        $device=Device::find($id);
        if(is_null($device))
        {
            return response()->json(null,404);

        }

        $response=new DeviceResource(Device::findOrFail($id),200);
        return response()->json($response,200);
    }

    public  function store(Request $request)
    {
        $rules=[
         
            'name'=>'required',
             
        ];
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

       
        $device=Device::create([
            'name' => request('name')        

        ]);
        return response()->json(['message' => 'Device added succesfully','data'=>$device], 200);


    }

    public  function update(Request $request, Device $device)
    {
        $device->update($request->all());
        return response()->json($device,200);

    }


    public  function delete(Request $request, Device $device)
    {
        $device->delete();
        return response()->json(null,204);

    }

    public  function errors()
    {
        return response()->json(["message"=>"Error occurred"],501);

    }
}
