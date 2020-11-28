<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withFilters()
            ->where('is_active', '1')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return ProductResource::collection($products);
    }

    public function totalProducts()
    {
        $products = Product::where('is_active', '1')->get();

        return response()->json($products);
    }

    public function productDetail($id)
    {
        $product = Product::find($id);
        $images = ProductImage::where('product_id', $id)->with('product')->get();
        $company = Product::find($id)->user;
        $category = Product::find($id)->category;
        $subcategory = Product::find($id)->subcategory;
        
        return response()->json([
            'product' => $product,
            'images' => $images,
            'company' => $company,
            'category' => $category,
            'subcategory' => $subcategory,
        ]);
    }

    public function updateProduct(Request $request, $id)
    {    

        $images = $request->images;
        $user_id = Auth::id();

        if($request->hasFile('images')) {
            
            $imgp = DB::table('product_images')->where('product_id', $id)->get();
            
            //delete image on table product_images firts----
            for($i=0; $i<count($imgp); $i++){
                if($imgp[$i]->image_path){
                    Storage::delete('/public/'.$imgp[$i]->image_path);
                }
            }

            // get index 0 of images array----
            foreach($images as $image_product){}

            $filenamewithextension = $image_product->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $image_product->getClientOriginalExtension();
            $filenametostore = $filename.'_'.$user_id.'.'.$extension;

            $product = Product::find($id);
            $product->name = $request->get('name');
            $product->description = $request->get('description');
            $product->sni = $request->get('sni');
            $product->nomor_sni =  $request->get('nomor_sni');
            $product->tkdn = $request->get('tkdn');
            $product->nilai_tkdn = $request->get('nilai_tkdn');
            $product->nomor_sertifikat_tkdn = $request->get('nomor_sertifikat_tkdn');
            $product->nomor_laporan_tkdn = $request->get('nomor_laporan_tkdn');
            $product->price = $request->get('price');
            $product->hs_code = $request->get('hs_code');
            $product->category_id = $request->get('category_id');
            $product->subcategory_id = $request->get('subcategory_id');
            $product->is_active = 0;
            $product->image_path = 'images/'.$filenametostore;
            $product->save();

            // delete product_images first, then insert with the new images
            DB::table('product_images')->where('product_id', '=', $id)->delete();

            foreach($images as $image) {
                $filenamewithextension = $image->getClientOriginalName();
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $filenametostore = $filename.'_'.$user_id.'.'.$extension;
                $image->storeAs('public/images', $filenametostore);        
                $imagePath = public_path('storage/images/'.$filenametostore);
                $imgSave = Image::make($imagePath)->fit(300);
                $imgSave->save($imagePath);
                
                ProductImage::create([
                    'name' => $request->get('name'),
                    'product_id' => $id,
                    'image_path' => 'images/'.$filenametostore,
                ]);
            }
        }
        else{
            $product = Product::find($id);
            $product->name = $request->get('name');
            $product->description = $request->get('description');

            $product->sni = $request->get('sni');
            $product->nomor_sni =  $request->get('nomor_sni');

            $product->tkdn = $request->get('tkdn');
            $product->nilai_tkdn = $request->get('nilai_tkdn');
            $product->nomor_sertifikat_tkdn = $request->get('nomor_sertifikat_tkdn');
            $product->nomor_laporan_tkdn = $request->get('nomor_laporan_tkdn');

            $product->price = $request->get('price');
            $product->hs_code = $request->get('hs_code');
            $product->category_id = $request->get('category_id');
            $product->subcategory_id = $request->get('subcategory_id');
            $product->is_active = 0;
            $product->save();

            DB::table('product_images')->where('product_id', $id)->update([
                'name' => $product->name
            ]);
        }
        // return redirect('/member')->with('success', 'product '.$product->name.' updated successfully');
        return response()->json(['message' => 'product successfuly updated']);
    }

    public function destroy($id)
    {
        $images = ProductImage::where('product_id', $id)->get();
        foreach($images as $image){
            Storage::disk('public')->delete($image->image_path);
        }

        ProductImage::where('product_id', $id)->delete();
        Product::where('id', $id)->delete();
        return redirect('/member')->with('success', 'data deleted successfully');
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description'=> 'required|min:20',
            'price' => 'required',
            'hs_code' => 'required|min:3',
            'category_id' => 'required',
            'images' => 'required'
        ]); 

        DB::transaction(function () use ($request) {
            $name = $request->name;
            $description = $request->description;
            $sni = $request->sni;
            $nomor_sni = $request->nomor_sni;
            $tkdn = $request->tkdn;
            $nilai_tkdn = $request->nilai_tkdn;
            $nomor_sertifikat_tkdn = $request->nomor_sertifikat_tkdn;
            $nomor_laporan_tkdn = $request->nomor_laporan_tkdn;
            $price = $request->price;
            $hs_code = $request->hs_code;
            $category_id = $request->category_id;
            $subcategory_id = $request->subcategory_id;
            $images = $request->images;
            $user_id = Auth::id();
            $provinsi_id = Auth::user()->provinsi_id;
            $kabupaten_id = Auth::user()->kabupaten_id;
            $kecamatan_id = Auth::user()->kecamatan_id;
            $company_name = Auth::user()->name;

            if($request->hasFile('images')) {
                foreach($images as $image_product)
                //get filename with extension
                $filenamewithextension = $image_product->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        
                //get file extension
                $extension = $image_product->getClientOriginalExtension();
        
                //filename to store
                $filenametostore = $filename.'_'.$user_id.'.'.$extension;

                $product = Product::create([
                    'name' => $name,
                    'description' => $description,
                    'sni' => $sni,
                    'nomor_sni' => $nomor_sni,
                    'tkdn' => $tkdn,
                    'nilai_tkdn' => $nilai_tkdn,
                    'nomor_sertifikat_tkdn' => $nomor_sertifikat_tkdn,
                    'nomor_laporan_tkdn' => $nomor_laporan_tkdn,
                    'price' => $price,
                    'hs_code' => $hs_code,
                    'category_id' => $category_id,
                    'subcategory_id' => $subcategory_id,
                    'user_id' => $user_id,
                    'company_name' => $company_name,
                    'provinsi_id' => $provinsi_id,
                    'kabupaten_id' => $kabupaten_id,
                    'kecamatan_id' => $kecamatan_id,
                    'image_path' => 'images/'.$filenametostore
                ]);

                // store each image
                foreach($images as $image) {
                    //get filename with extension
                    $filenamewithextension = $image->getClientOriginalName();
            
                    //get filename without extension
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            
                    //get file extension
                    $extension = $image->getClientOriginalExtension();
            
                    //filename to store
                    $filenametostore = $filename.'_'.$user_id.'.'.$extension;
            
                    //Upload File
                    $image->storeAs('public/images', $filenametostore);
            
                    $imagePath = public_path('storage/images/'.$filenametostore);

                    ProductImage::create([
                        'name' => $product->name,
                        'product_id' => $product->id,
                        'image_path' => 'images/'.$filenametostore,
                    ]);
                }
            }
        });
        return response()->json(200);
    }
}
