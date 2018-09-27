<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','client_type','service_type_id','vendor_status','sector_id','name','contact_person','mobile','bdm_person_id', 'email',
         'address'
    ];

     

    public function sector()
    {
        return $this->belongsTo('App\Models\Sector');
    }

    public function bdmperson()
    {
        return $this->belongsTo('App\Models\BdmPerson', 'bdm_person_id');
    }

    public function serviceType()
    {
        return $this->belongsTo('App\Models\ServiceType', 'service_type_id');
    }
   
}
