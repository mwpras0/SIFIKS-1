<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    /**
     * @var string
     */
    protected $table = 'medicine';

    /**
     * @var string
     */
    public $primarykey = 'id';

    /**
     * @var bool
     */
    public $timestamp = true;

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

}
