<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';
    protected $primaryKey = 'app_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'app_id',
        'exp_id',
        'client_id',
        'app_form',
        'app_date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->app_id)) {
                $model->app_id = static::generateAppId();
            }
        });
    }

    protected static function generateAppId(): string
    {
        $year = now()->format('Y');
        $prefix = "APP-{$year}-";
        $last = static::where('app_id', 'like', $prefix . '%')
            ->orderBy('app_id', 'desc')
            ->first();

        $next = $last
            ? ((int) substr($last->app_id, -6) + 1)
            : 1;

        return $prefix . str_pad($next, 6, '0', STR_PAD_LEFT);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class, 'exp_id', 'exp_id');
    }
}