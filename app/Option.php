<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wp_options';

    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'option_id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'autoload',
    ];
}