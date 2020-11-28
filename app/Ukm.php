<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    public function scopeWithFilters($query)
    {
        return $query
        ->when(request()->input('keyword'), function ($query) {
            $query->where('nama_usaha', 'like', '%'.request()->input('keyword').'%');
        })
        ->when(request()->input('keyword'), function ($query) {
            $query->where('nama_pemilik', 'like', '%'.request()->input('keyword').'%');
        })
        ->when(request()->input('keyword'), function ($query) {
            $query->where('omset1', 'like', '%'.request()->input('keyword').'%');
        })
        ->when(request()->input('keyword'), function ($query) {
            $query->where('omset2', 'like', '%'.request()->input('keyword').'%');
        });
    }
}
