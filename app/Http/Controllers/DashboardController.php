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
