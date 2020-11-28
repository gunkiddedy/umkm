<?php

namespace App;

use App\Provinsi;
use Illuminate\Database\Eloquent\Model;

class Island extends Model
{
    public function provinsis()
    {
        return $this->hasMany(Provinsi::class);
    }
}
