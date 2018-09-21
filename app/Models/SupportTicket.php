<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{

    use Notifiable;

    protected $fillable = [
       'client_id', 'service_type_id',
        'description', 'project_details', 'start_date','end_date',
            'status',  'officer1','officer2','officer3',  'attachment'];

    
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function serviceType()
    {
        return $this->belongsTo('App\Models\ServiceType');
    }

   
    public function officer1()
    {
        return $this->belongsTo('App\Models\Auth\User');
    }
    public function officer2()
    {
        return $this->belongsTo('App\Models\Auth\User');
    }
    public function officer3()
    {
        return $this->belongsTo('App\Models\Auth\User');
    }
   
}
