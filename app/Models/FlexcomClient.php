<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class FlexcomClient extends Model
{

    use Notifiable;

    protected $fillable = ['client_id'];

    
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

   
   
}
