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
        'id','client_type','vendor_status','sector_id','name','contact_person','mobile','bdm_person_id', 'email',
         'address'
    ];

   
}
