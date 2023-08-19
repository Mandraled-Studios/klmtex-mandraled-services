<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        //dd(Product::first()->productable->name);
        return view("products.index")->with([
            "products" => $products
        ]);
    }

    public function create() {
        $foreigns = array();
        return view("products.create")->with([
            "foreigns" => $foreigns
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|min:2|max:255',
            'metatitle' => 'nullable|sometimes|max:255',
            'keywords' => 'nullable|sometimes|max:255',
            'slug' => 'required|max:128|unique:mysql2.products,slug',
            'short_description' => 'nullable|sometimes|max:255',
            'long_description' => 'nullable|sometimes',
            'thumbnail_path' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'tag1' => 'nullable|sometimes|max:30',
            'tag2' => 'nullable|sometimes|max:30',
            'is_active' => '',
            'productable_id' => 'required|min:2|max:128',
            'productable_type' => 'required|min:2|max:255',
            'has_variants' => '',
            'is_stock_monitored' => '',
            'has_highlights' => '',
            'has_banner' => '',
            'has_attributes' => '',
            'has_offers' => '',
            'has_attachments' => '',
            'allows_questions' => '',
            'tax_slab' => 'nullable|sometimes|between:0,99.99',
            'features' => 'nullable|sometimes|min:5',
            'productable_id' => 'required',
            'productable_type' => 'required|max:255',
            'submit' => 'required'

        ]);

        if($request->hasFile('thumbnail_path')) {
            
            //Set filename
            $filename = $request->slug.'-'.random_int(1111, 9999).'-'.substr(time(), 0, 10);    
            //Get extension of file
            $extension =  $request->file('thumbnail_path')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename . "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('thumbnail_path')->storeAs('public/images/products/', $filenameToStore);
            $data['thumbnail_path'] = "/storage/images/products/" . $filenameToStore;
      
        } else {
            $data['thumbnail_path'] = NULL;
        }

        if(isset($request->is_active)) {
            $data['is_active'] = true;
        } else {
            $data['is_active'] = false;
        } 

        if(isset($request->has_variants)) {
            $data['has_variants'] = true;
        } else {
            $data['has_variants'] = false;
        } 

        if(isset($request->is_stock_monitored)) {
            $data['is_stock_monitored'] = true;
        } else {
            $data['is_stock_monitored'] = false;
        } 

        if(isset($request->has_highlights)) {
            $data['has_highlights'] = true;
        } else {
            $data['has_highlights'] = false;
        }
        
        if(isset($request->has_banner)) {
            $data['has_banner'] = true;
        } else {
            $data['has_banner'] = false;
        }

        if(isset($request->has_attributes)) {
            $data['has_attributes'] = true;
        } else {
            $data['has_attributes'] = false;
        } 

        if(isset($request->has_offers)) {
            $data['has_offers'] = true;
        } else {
            $data['has_offers'] = false;
        } 

        if(isset($request->has_attachments)) {
            $data['has_attachments'] = true;
        } else {
            $data['has_attachments'] = false;
        } 

        if(isset($request->allows_questions)) {
            $data['allows_questions'] = true;
        } else {
            $data['allows_questions'] = false;
        } 

        $new_product = Product::create($data);

        if($data['submit'] == 'Create Product & Exit') {
            return redirect(route('products'))->with([
                "success" => "New product has been created"
            ]);
        } else if($data['submit'] == 'Save & Proceed to Next Step') {
            return redirect(route('products.variants.index', ["id" => $new_product->id]))->with([
                "success" => "New product has been created"
            ]);
        }
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        $foreigns = array();
        return view("products.edit")->with([
            "product" => $product,
            "foreigns" => $foreigns
        ]);
    }

    public function update($id, Request $request) {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|min:2|max:255',
            'metatitle' => 'nullable|sometimes|max:255',
            'keywords' => 'nullable|sometimes|max:255',
            'slug' => 'required|max:128|unique:mysql2.products,slug,'.$product->id,
            'short_description' => 'nullable|sometimes|max:255',
            'long_description' => 'nullable|sometimes',
            'thumbnail_path' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'tag1' => 'nullable|sometimes|max:30',
            'tag2' => 'nullable|sometimes|max:30',
            'is_active' => '',
            'productable_id' => 'required|min:2|max:128',
            'productable_type' => 'required|min:2|max:255',
            'has_variants' => '',
            'is_stock_monitored' => '',
            'has_highlights' => '',
            'has_banner' => '',
            'has_attributes' => '',
            'has_offers' => '',
            'has_attachments' => '',
            'allows_questions' => '',
            'tax_slab' => 'nullable|sometimes|between:0,99.99',
            'features' => 'nullable|sometimes|min:5',
            'productable_id' => 'required',
            'productable_type' => 'required|max:255',
            'submit' => 'required'

        ]);

        if($request->hasFile('thumbnail_path')) {
            
            //Set filename
            $filename = $request->slug.'-'.random_int(1111, 9999).'-'.substr(time(), 0, 10);    
            //Get extension of file
            $extension =  $request->file('thumbnail_path')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename . "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('thumbnail_path')->storeAs('public/images/products/', $filenameToStore);
            $data['thumbnail_path'] = "/storage/images/products/" . $filenameToStore;
      
        } 

        if(isset($request->is_active)) {
            $data['is_active'] = true;
        } else {
            $data['is_active'] = false;
        } 

        if(isset($request->has_variants)) {
            $data['has_variants'] = true;
        } else {
            $data['has_variants'] = false;
        } 

        if(isset($request->is_stock_monitored)) {
            $data['is_stock_monitored'] = true;
        } else {
            $data['is_stock_monitored'] = false;
        } 

        if(isset($request->has_highlights)) {
            $data['has_highlights'] = true;
        } else {
            $data['has_highlights'] = false;
        }
        
        if(isset($request->has_banner)) {
            $data['has_banner'] = true;
        } else {
            $data['has_banner'] = false;
        }

        if(isset($request->has_attributes)) {
            $data['has_attributes'] = true;
        } else {
            $data['has_attributes'] = false;
        } 

        if(isset($request->has_offers)) {
            $data['has_offers'] = true;
        } else {
            $data['has_offers'] = false;
        } 

        if(isset($request->has_attachments)) {
            $data['has_attachments'] = true;
        } else {
            $data['has_attachments'] = false;
        } 

        if(isset($request->allows_questions)) {
            $data['allows_questions'] = true;
        } else {
            $data['allows_questions'] = false;
        } 

        $product->update($data);

        if($data['submit'] == 'Save Product & Exit') {
            return redirect(route('products'))->with([
                "success" => "SKU details added"
            ]);
        } else if($data['submit'] == 'Save & Proceed to Next Step') {
            return abort(403, "The next step is still under construction");
        }

    }

    public function delete($id) {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect(route('products'))->with([
            "danger" => "Product has been removed"
        ]);
    }

    public function search(Request $request) {
        $products = Product::where('name', 'like', '%'.$request->term.'%')->get();
        return view("products.index")->with([
            "products" => $products,
            "term" => $request->term
        ]);
    }
}
