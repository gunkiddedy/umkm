<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// SANCTUM AREA
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
});



// ==================ADMIN AREA=====================================
// Route::get('company-list', 'Api\AdminController@companyList');
// Route::get('product-list', 'Api\AdminController@productList');

                // approv or reject user product
// Route::post('approving-product/{id}', 'Api\AdminController@approvingProduct');

                // show more/less image 
// Route::get('product-list-detail-image/{id}', 'Api\AdminController@productListDetailImage');

                // show user blacklisted
// Route::get('user-blacklist', 'Api\AdminController@userBlacklist');

                // set user active or inactive
// Route::post('set-user-active/{id}', 'Api\AdminController@setUserActive');
// Route::post('set-user-inactive/{id}', 'Api\AdminController@setUserInActive');

                // count request
// Route::get('company-request', 'Api\AdminController@companyRequest');
// Route::get('product-request', 'Api\AdminController@productRequest');
// Route::get('blacklist-request', 'Api\AdminController@blacklistRequest');
// ===========================END ADMIN AREA-=====================================



// =============== MEMBER AREA==================================
Route::post('add-product', 'Api\ProductController@addProduct');
Route::get('ukms/{desa_id}', 'UkmDesaController@getRecords');
// Route::post('update-product/{id}', 'Api\ProductController@updateProduct');
// Route::post('update-company-info/{id}', 'Api\CompanyController@updateCompanyProfile');
// ================END MEMBER ==================================



// ==============================PUBLIC AREA==================================
Route::post('logout', 'AuthController@logout');
Route::post('login', 'AuthController@login')->name('login');
Route::post('register', 'AuthController@register');

// Route::get('products', 'Api\ProductController@index');
// Route::get('search-products', 'Api\ProductController@search');
// Route::get('total-products', 'Api\ProductController@totalProducts');
// Route::get('product-detail/{id}', 'Api\ProductController@productDetail');
// Route::get('company-detail/{id}', 'Api\CompanyController@companyDetail');

// get category and subcategory (dependent dropdown)
// Route::get('getcategories', 'Api\CategoryController@getCategory');
// Route::get('get-subcategories-by-category-id', 'Api\CategoryController@getSubCategory');

// get all subcategories
// Route::get('get-subcategories', 'Api\CategoryController@getSubCategories');

// get all of provinsi with their island (jawa, sumatera, kalimantan etc...)
// Route::get('get-island-with-provinsis', 'Api\WilayahController@getIslandWithProvinsis');
// Route::get('get-kabupatens-by-provinsi-id', 'Api\WilayahController@getKabupaten');
// =======================END PUBLIC======================================================



