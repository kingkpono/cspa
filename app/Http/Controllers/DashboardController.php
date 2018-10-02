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
        return Client::where('client_type','Client')->count();
    }

    public  function getProspectsCount()
    {
        return Client::where('client_type','Prospect')->count();
    }

    public function getCounts()
    {

        
        return response()->json([
            'prospectsCount'=>$this->getProspectsCount(),
            'clientsCount'=>$this->getClientsCount(),
            'cctvClosedTicketsCount'=>$this->getClosedCctvTicketsCount(),
            'flexcomClosedTicketsCount'=>$this->getClosedFlexcomTicketsCount(),
            'tamsClosedTicketsCount'=>$this->getClosedTamsTicketsCount(),
            'staffCount'=>$this->getStaffCount(),    
            'cctvOpenTicketsCount'=>$this->getOpenCctvTicketsCount(),
            'flexcomOpenTicketsCount'=>$this->getOpenFlexcomTicketsCount(),
            'tamsOpenTicketsCount'=>$this->getOpenTamsTicketsCount(),
            'openSupportTicketsCount'=>$this->getOpenSupportTickets(),
            'openSalesTicketsCount'=>$this->getOpenSalesTickets(),
            'clientsCount'=>$this->getClientsCount(),
        ],200);

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

    public  function getOpenCctvTicketsCount()
    {
        $cctvCount=SupportTicket::whereRaw('service_type_id=3 AND (status="Pending" OR status="In Progress")')->count();
 
        return $cctvCount;
    }

    public  function getOpenTamsTicketsCount()
    {
        $tamsCount=SupportTicket::whereRaw('service_type_id=1 AND (status="Pending" OR status="In Progress")')->count();
 
        return $tamsCount;
    }

    public  function getOpenFlexcomTicketsCount()
    {
        $flexCount=SupportTicket::whereRaw('service_type_id=2 AND (status="Pending" OR status="In Progress")')->count();
 
        return $flexCount;
    }




    public  function getClosedCctvTicketsCount()
    {
        $cctvCount=SupportTicket::whereRaw('service_type_id=3 AND status="Closed"')->count();
 
        return $cctvCount;
    }

    public  function getClosedTamsTicketsCount()
    {
        $tamsCount=SupportTicket::whereRaw('service_type_id=1 AND status="Closed" ')->count();
 
        return $tamsCount;
    }

    public  function getClosedFlexcomTicketsCount()
    {
        $flexCount=SupportTicket::whereRaw('service_type_id=2 AND status="Closed"')->count();
 
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
            'openTamsTicketsCount'=>$this->getMyOpenTamsTicketsCount($id),
            'openCctvTicketsCount'=>$this->getMyOpenCctvTicketsCount($id),
            'openFlexcomTicketsCount'=>$this->getMyOpenFlexcomTicketsCount($id),


        ],200);

    }


    public  function getMyOpenTamsTicketsCount($id)
    {
        $supportTickets=SupportTicket::whereRaw('service_type_id=1 AND officer1='.$id.' OR officer2='.$id.' OR officer3='.$id)->count();
        
        if(is_null($supportTickets))
        {
            return 0;

        }    
        
        return  $supportTickets;
    }

    
    public  function getMyOpenCctvTicketsCount($id)
    {
        $supportTickets=SupportTicket::whereRaw('service_type_id=2 AND officer1='.$id.' OR officer2='.$id.' OR officer3='.$id)->count();
        
        if(is_null($supportTickets))
        {
            return 0;

        }    
        
        return  $supportTickets;
    }

    
    public  function getMyOpenFlexcomTicketsCount($id)
    {
        $supportTickets=SupportTicket::whereRaw('service_type_id=3 AND officer1='.$id.' OR officer2='.$id.' OR officer3='.$id)->count();
        
        if(is_null($supportTickets))
        {
            return 0;

        }    
        
        return  $supportTickets;
    }

    


    

}
