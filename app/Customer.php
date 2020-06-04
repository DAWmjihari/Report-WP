<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'wp_bookly_customers';

    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'id';
}