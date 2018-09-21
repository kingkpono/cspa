<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SalesTicket extends Model
{

    use Notifiable;

    protected $fillable = [
       'client_id', 'service_type_id' ,'device','serial_number', 
        'device_description', 'ticket_contact_email', 'ticket_contact_phone','device_warranty','project_details', 'start_date','end_date',
            'status','officer1','officer2','officer3', 'attachment'];

    
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function serviceType()
    {
        return $this->belongsTo('App\Models\ServiceType', 'service_type_id');
    }

    public function officer1()
    {
        return $this->belongsTo('App\Models\Auth\User', 'officer1');
    }
    public function officer2()
    {
        return $this->belongsTo('App\Models\Auth\User','officer2');
    }
    public function officer3()
    {
        return $this->belongsTo('App\Models\Auth\User','officer3');
    }

   
  
}
