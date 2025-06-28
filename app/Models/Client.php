<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $primaryKey   = 'client_id';
    public    $incrementing = false;
    protected $keyType      = 'string';
    public    $timestamps   = false;

    protected $fillable = [
        'surname','given_name','middle_name',
        'gender','age','birthdate','phone_number',
        'civil_status','job_status','province','city',
        'barangay','street','occupation','monthly_income',
        'house_status','lot_status','philhealth_affiliation',
        'philhealth_category','time_registered'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($m){
            $year   = date('Y');
            $prefix = "CLI-{$year}-";
            $last   = static::where('client_id','like',"{$prefix}%")
                             ->orderBy('client_id','desc')
                             ->first();
            $n      = $last
                      ? (int)substr($last->client_id, strlen($prefix)) + 1
                      : 1;
            $m->client_id     = $prefix.str_pad($n,6,'0',STR_PAD_LEFT);
            $m->time_registered = now();
        });
    }

    public function scopeSearch($query, $term)
    {
        return $query->when($term, function ($q) use ($term) {
            $q->where('surname',    'like', "%{$term}%")
              ->orWhere('given_name','like', "%{$term}%")
              ->orWhere('middle_name','like', "%{$term}%");
        });
    }

    public function emergencyContacts()
    {
        return $this->hasMany(EmergencyContact::class,'client_id','client_id');
    }

    public function householdMembers()
    {
        return $this->hasMany(HouseholdMember::class,'client_id','client_id');
    }
}