<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    const CREATED_AT = 'time_registered';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'user_id',
        'username',
        'given_name',
        'middle_name',
        'surname',
        'role',
        'phone_number',
        'plaintext_password',
        'hashed_password',
        'profile_picture',
        'time_registered',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'hashed_password',
        'remember_token',
    ];

    protected $casts = [
        'time_registered' => 'datetime',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
        'password'        => 'hashed',
    ];

    public function getFullNameAttribute()
    {
        $fullName = $this->surname . ', ' . $this->given_name;
        if ($this->middle_name) {
            $fullName .= ' ' . substr($this->middle_name, 0, 1) . '.';
        }
        return $fullName;
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', '%' . $search . '%')
                  ->orWhere('given_name', 'like', '%' . $search . '%')
                  ->orWhere('middle_name', 'like', '%' . $search . '%')
                  ->orWhere('surname', 'like', '%' . $search . '%')
                  ->orWhere('contact_number', 'like', '%' . $search . '%')
                  ->orWhere('phone_number', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }
}