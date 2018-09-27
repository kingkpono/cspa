<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class FlexcomLine extends Model
{

    use Notifiable;

    protected $fillable = ['client_id','platform','mobile_number','activation_date','status','remark'];

    
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

   
   
}
