<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index($id) {
        $product = Product::findOrFail($id);
        $banners = $product->banners;
        return view("products.banners.index")->with([
            "product" => $product,
            "banners" => $banners
        ]);
    }

    public function store($id, Request $request) {
        $data = $request->validate([
            'position' => 'required|min:4|max:64',
            'banner' => 'required|image|mimes:png,jpg,svg',
            'product_id' => '',
        ]);

        $product_slug = Product::findOrFail($id)->slug;

        $data['product_id'] = $id;

        if($request->hasFile('banner')) {
            //Get full filename with extension
            $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $product_slug), 0, 20)."-".random_int(1000,9999);      
            //Get extension of file
            $extension =  $request->file('banner')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename. "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('banner')->storeAs('public/images/banners/products/', $filenameToStore);
            $data['banner'] = "/storage/images/banners/products/" . $filenameToStore;
        } else {
            $data['banner'] = NULL;
        }

        Banner::create([
            "product_id" => $data['product_id'],
            "banner" => $data['banner'],
            "position" => $data['position'],
            
        ]);


        if($request->submit == 'Save & Add One More Banner') {
            return redirect(route('products.banners.index', ['id' => $id]))->with([
                "success" => "Highlight has been created"
            ]);
        } else if($request->submit == 'Save & Proceed to Next Step') {
            return redirect(route('products.attributes.index', ['id' => $id]))->with([
                "success" => "Highlight has been created"
            ]);
        }
    }

    public function delete($id, $bid) {
        $banner = Banner::findOrFail($bid);
        $banner->delete();
        return redirect()->back()->with([
            "danger" => "Banner has been removed"
        ]);
    }
}
