<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CassObject extends Model
{

    use Notifiable;

    protected $fillable = [
       'client_id', 'service_type_id' ,'cass_type_id','due_month', 
        'due_year', 'location', 'remark','added_by'];

    
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function serviceType()
    {
        return $this->belongsTo('App\Models\ServiceType', 'service_type_id');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'added_by');
    }
    public function CassType()
    {
        return $this->belongsTo('App\Models\CassType', 'cass_type_id');
    }

   
   
}
