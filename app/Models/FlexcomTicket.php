<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class FlexcomTicket extends Model
{

    use Notifiable;

    protected $fillable = ['support_ticket_id','issue_type','mobile_numbers'];

    
    public function supportTicket()
    {
        return $this->belongsTo('App\Models\SupportTicket');
    }

   
   
}
