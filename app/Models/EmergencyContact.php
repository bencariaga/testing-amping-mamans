<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    protected $table        = 'emergency_contacts';
    protected $primaryKey   = 'contact_id';
    public    $incrementing = false;
    protected $keyType      = 'string';
    public    $timestamps   = false;

    protected $fillable = [
        'client_id','surname','given_name','middle_name',
        'gender','age','birthdate','contact_number',
        'relationship','monthly_income','education','time_created'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($m){
            $year   = date('Y');
            $prefix = "EC-{$year}-";
            $last   = static::where('contact_id','like',"{$prefix}%")
                             ->orderBy('contact_id','desc')
                             ->first();
            $n      = $last
                      ? (int)substr($last->contact_id, strlen($prefix)) + 1
                      : 1;
            $m->contact_id  = $prefix.str_pad($n,6,'0',STR_PAD_LEFT);
            $m->time_created = now();
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id','client_id');
    }
}