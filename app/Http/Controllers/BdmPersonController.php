<?php

namespace App\Http\Controllers;
use App\Models\BdmPerson;
use App\Http\Resources\BdmPerson as  BdmPersonResource;
use Illuminate\Http\Request;

use Validator;

class BdmPersonController extends Controller
{
   public function model()
    {
        return BdmPerson::class;
    }

    public  function index()
    {
        return response()->json(BdmPerson::get(),200);
    }

    public  function show($id)
    {
        $BdmPerson=BdmPerson::find($id);
        if(is_null($BdmPerson))
        {
            return response()->json(null,404);

        }

        $response=new BdmPersonResource(BdmPerson::findOrFail($id),200);
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

       
        $BdmPerson=BdmPerson::create([
            'name' => request('name'),
            

        ]);
        return response()->json(['message' => 'Business Development Person added successfully','data'=>$BdmPerson], 200);


    }
     
    public  function update(Request $request, BdmPerson $bdmPerson)
    {
        $bdmPerson>update($request->all());
        return response()->json($bdmPerson,200);

    }

    public  function delete(Request $request, BdmPerson $BdmPerson)
    {
        $BdmPerson->delete();
        return response()->json(null,204);

    }

    public  function errors()
    {
        return response()->json(["message"=>"Error occurred"],501);

    }
}
