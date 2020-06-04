<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'wp_bookly_appointments';

    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'id';


    public function customers()
    {
        return $this->belongsToMany('App\Customer', 'wp_bookly_customer_appointments')->withPivot('status')->withPivot('status_changed_at');
        ;
    }
}