<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Expense extends Model
{
    use HasFactory, Searchable;

    protected $table = 'expenses';
    protected $primaryKey = 'exp_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'exp_id',
        'app_id',
        'app_date',
        'assist_mny_amt',
        'med_type',
    ];

    public function toSearchableArray(): array
    {
        return [
            'exp_id'         => $this->exp_id,
            'app_id'         => $this->app_id,
            'app_date'       => $this->app_date,
            'assist_mny_amt' => $this->assist_mny_amt,
            'med_type'       => $this->med_type,
        ];
    }
}