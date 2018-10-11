<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Auth\User;
use App\Http\Resources\Client as  ClientResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Mail\TicketAssigned;
use Illuminate\Support\Facades\Mail;

use Validator;


class ClientController extends Controller
{
   public function model()
    {
        return Client::class;
    }

    public  function index()
    {
        return response()->json(Client::with('bdmperson')->with('sector')->with('serviceType')->get(),200);
    }

    public  function getClientsByTypeAndSector($clientType,$sector_id)
    {    
        return response()->json(Client::where('client_type', $clientType)->where('sector_id',
         $sector_id)->with('bdmperson')->with('sector')->with('serviceType')->get(),200);
    }

   
    
    public  function getClientsByBdmId($id)
    {    
        return response()->json(Client::where('bdm_person_id', $id)->with('sector')->with('serviceType')->with('bdmperson')->get(),200);
    }
    
    public  function getClientsBySectorId($id)
    {    
        return response()->json(Client::where('sector_id', $id)->with('bdmperson')->with('serviceType')->with('sector')->get(),200);
    }
    
    public  function getClientsByType($type)
    {
        return response()->json(Client::where('client_type',$type)->with('bdmperson')->with('serviceType')->with('sector')->get(),200);
    }

    

    public  function show($id)
    {
        $client=Client::find($id);
        if(is_null($client))
        {
            return response()->json(null,404);

        }

        $response=new ClientResource(Client::findOrFail($id)->with('bdmperson')->with('serviceType')->with('sector')->get(),200);
        return response()->json($response,200);
    }

    

    public  function store(Request $request)
    {
        $rules=[
            'client_type'=>'required',
            'name'=>'required',
            'email'=>['required','unique:clients,email'],
            'sector_id' => 'required|numeric',
            'vendor_status'=>'required',
            'service_type_id'=>'required',
            'contact_person' =>'required',
            'mobile' =>'required_without:work_phone',
            'work_phone' =>'required_without:mobile',
            'bdm_person_id' =>'required|numeric',
            'address' =>'required',
            'address' =>'required'

        ];
      //try{
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return $this->error($validator->errors(),400);
        }
        
       
        $client=Client::create([
            'name' => request('name'),
            'email' => request('email'),
            'client_type' => request('client_type'),
            'sector_id' => request('sector_id'),
            'service_type_id' => request('service_type_id'),
            'vendor_status' => request('vendor_status'),
            'contact_person' => request('contact_person'),
            'mobile'       => request('mobile'),
            'work_phone'       => request('work_phone'),
            'bdm_person_id'       => request('bdm_person_id'),
            'address'          => request('address')

        ]);
        if($client)
        {
           $content="A new Client has been assigned to you on CSPA.";
            //get BDM/User email
           

               Mail::send('emails.ticketassigned', ['title' => 'CSPA New Client ', 'content' => $content], function ($message)
                {
                    $userModel=User::select('*')->where('id',request('bdm_person_id'))->get();

                    $user=null;
                    foreach ($userModel as $usr) 
                    $user=$usr;
                    $message->from('no-reply@sbtelecoms.com', 'CSPA Admin');
                     $message->subject("CSPA New Client");
                    $message->to($user->email,$user->name);
        
        
                });
            
    
            

       
        }
    
        return response()->json(['message' => 'Client added successfully','data'=>$client], 200);
   // } catch (\Exception $error) {
      // return response()->json('Error creating client', 501);
   //}



    }

    public  function delete(Request $request, Client $client)
    {
        $client->delete();
        return response()->json(null,204);

    }
    
    public  function update(Request $request, Client $client)
    {
        $client->update($request->all());
     
        return response()->json($client,200);

    }

   

    
}
