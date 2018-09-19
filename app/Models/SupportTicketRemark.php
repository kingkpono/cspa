<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SupportTicketRemark extends Model
{

    use Notifiable;

    protected $fillable = [
       'id', 'user_id',
        'support_ticket_id', 'remark'];

    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function supportTicket()
    {
        return $this->belongsTo('App\Models\SupportTicket', 'support_ticket_id');
    }

   
   
}
