<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;

    protected $table = 'services';

    protected $primaryKey = 'service_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'service_id',
        'med_assist_type',
        'exp_range_min',
        'exp_range_max',
        'assist_amt',
    ];

    protected $casts = [
        'exp_range_min' => 'decimal:2',
        'exp_range_max' => 'decimal:2',
        'assist_amt'    => 'decimal:2',
    ];
}