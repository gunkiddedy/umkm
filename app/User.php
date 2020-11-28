<?php

namespace App;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'tkdn', 
        'provinsi_id', 'kabupaten_id', 'kecamatan_id', 
        'address', 'nib', 'additional_info', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // user hanya memiliki satu provinsi (inverse from provinsi)
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    // user hanya memiliki satu kabupaten (inverse from kabupaten)
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    // user hanya memiliki satu kecamatan (inverse from kecamatan)
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    // accessor function
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function scopeWithFilters($query)
    {
        return $query->when(request()->input('keyword'), function ($query) {
            $query->where('name', 'like', '%'.request()->input('keyword').'%');
        });
    }
}
