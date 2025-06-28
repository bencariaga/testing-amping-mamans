<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class GuaranteeLetter extends Model
{
    use HasFactory, Searchable;

    protected $table = 'guarantee_letters';
    protected $primaryKey = 'gl_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'gl_id',
        'app_id',
        'beneficiary',
        'med_type',
        'needed_mny_amt',
        'assist_mny_amt',
        'app_date',
        'app_status',
    ];

    public function toSearchableArray(): array
    {
        return [
            'gl_id'          => $this->gl_id,
            'app_id'         => $this->app_id,
            'beneficiary'    => $this->beneficiary,
            'med_type'       => $this->med_type,
            'app_status'     => $this->app_status,
            'app_date'       => $this->app_date,
        ];
    }
}