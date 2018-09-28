<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BdmPerson extends Model
{
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User');
    }
}
