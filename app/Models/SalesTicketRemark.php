<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SalesTicketRemark extends Model
{

    use Notifiable;

    protected $fillable = [
       'id', 'user_id',
        'sales_ticket_id', 'remark'];

    
    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User');
    }

    public function salesTicket()
    {
        return $this->belongsTo('App\Models\SalesTicket', 'sales_ticket_id');
    }

   
   
}
