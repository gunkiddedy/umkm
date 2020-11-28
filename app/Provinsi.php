<?php

namespace App;

use App\Island;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $fillable = ['name'];

    // provinsi memiliki banyak users (one to many)
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // provinsi memiliki banyak kabupaten (one to many)
    public function kabupatens()
    {
        return $this->hasMany(Kabupaten::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function island()
    {
        return $this->belongsTo(Island::class);
    }

    // ACCESSOR function
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }
    
}
