<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'description', 'category_id',
        'subcategory_id', 'user_id', 'company_name', 
        'provinsi_id', 'kabupaten_id', 
        'kecamatan_id', 'hs_code', 'sni', 'nomor_sni', 
        'tkdn', 'nilai_tkdn', 'nomor_sertifikat_tkdn', 
        'nomor_laporan_tkdn', 'image_path', 'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    // satu product mempunyai banyak image (one to many)
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // ----------accessor function--------------------
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
    public function getBrandAttribute($value)
    {
        return ucwords($value);
    }
    public function getCompanyNameAttribute($value)
    {
        return ucwords($value);
    }
    // --------------------------------------------

    public function scopeWithFilters($query)
    {
        return $query->when(count(request()->input('selectedCategory', [])), function ($query) {
            $query->whereIn('category_id', request()->input('selectedCategory'));
        })
        ->when(count(request()->input('selectedSubCategory', [])), function ($query) {
            $query->whereIn('subcategory_id', request()->input('selectedSubCategory'));
        })
        ->when(count(request()->input('selectedProvinsi', [])), function ($query) {
            $query->whereIn('provinsi_id', request()->input('selectedProvinsi'));
        })
        ->when(count(request()->input('selectedKabupaten', [])), function ($query) {
            $query->whereIn('kabupaten_id', request()->input('selectedKabupaten'));
        })
        ->when(request()->input('keywords'), function ($query) {
            $query->where('name', 'like', '%'.request()->input('keywords').'%');
        });
    }
}
