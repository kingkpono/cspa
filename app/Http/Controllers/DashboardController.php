<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Models\SupportTicket;
use App\Models\SalesTicket;
use App\Models\Client;


class DashboardController extends Controller
{
    
    public  function getStaffCount()
    {
        return User::where('role','Staff')->count();
    }


    public  function getOpenSupportTickets()
    {
        return SupportTicket::whereRaw('status="Pending" OR status="In Progress"')->count();
    }

    public  function getOpenSalesTickets()
    {
        return SalesTicket::whereRaw('status="Pending" OR status="In Progress"')->count();
    }

    
    public  function getClientsCount()
    {
        return Client::count();
    }

    public function getCounts()
    {

        
        return response()->json([
            'staffCount'=>$this->getStaffCount(),    
            'cctvTicketsCount'=>$this->getCctvTicketsCount(),
            'flexcomTicketsCount'=>$this->getFlexcomTicketsCount(),
            'tamsTicketsCount'=>$this->getTamsTicketsCount(),
            'openSupportTicketsCount'=>$this->getOpenSupportTickets(),
            'openSalesTicketsCount'=>$this->getOpenSalesTickets(),
            'clientsCount'=>$this->getClientsCount(),
        ],200)->header('Content-Type', 'application/json');

    }

    public  function myOpenSalesTickets($id)
    {
        $salesTickets=SalesTicket::whereRaw('officer1='.$id.' OR officer2='.$id.' OR officer3='.$id)->count();
        
        if(is_null($salesTickets))
        {
            return 0;

        }    
        
        return  $salesTickets;
    }

   
    public  function getCctvTicketsCount()
    {
        $cctvCount=SupportTicket::where('service_type_id',3)->count();
 
        return $cctvCount;
    }

    public  function getTamsTicketsCount()
    {
        $tamsCount=SupportTicket::where('service_type_id',1)->count();
 
        return $tamsCount;
    }

    public  function getFlexcomTicketsCount()
    {
        $flexCount=SupportTicket::where('service_type_id',2)->count();
 
        return $flexCount;
    }

    public  function myOpenSupportTickets($id)
    {
        $supportTickets=SupportTicket::whereRaw('officer1='.$id.' OR officer2='.$id.' OR officer3='.$id)->count();
        
        if(is_null($supportTickets))
        {
            return 0;

        }    
        
        return  $supportTickets;
    }
    public function getCountsForStaff($id)
    {

        
        return response()->json([
           
            'myOpenSupportTicketsCount'=>$this->myOpenSupportTickets($id),
            'openSalesTicketsCount'=>$this->getOpenSalesTickets($id),
            'clientsCount'=>$this->getClientsCount($id),
        ],200);

    }

    

}
