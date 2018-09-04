<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Http\Resources\Sector as  SectorResource;


use Validator;

class SectorController extends Controller
{
    
    public  function index()
    {
        return response()->json(Sector::get(),200);
    }

    public  function show($id)
    {
        $sector=Sector::find($id);
        if(is_null($sector))
        {
            return response()->json(null,404);

        }

        $response=new SectorResource(Sector::findOrFail($id),200);
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

       
        $sector=Sector::create([
            'name' => request('name'),
            'description' => request('description')          

        ]);
        return response()->json(['message' => 'Sector added succesfully','data'=>$sector], 200);


    }

    public  function update(Request $request, Sector $sector)
    {
        $sector->update($request->all());
        return response()->json($sector,200);

    }


    public  function delete(Request $request, Sector $sector)
    {
        $sector->delete();
        return response()->json(null,204);

    }

    public  function errors()
    {
        return response()->json(["message"=>"Error occurred"],501);

    }
}
