<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'wp_bookly_services';

    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'id';
}