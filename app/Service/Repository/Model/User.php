<?php

namespace App\Service\Repository\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * definied table name
     *
     * @var string
     */
    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'line_id'
    ];
}
