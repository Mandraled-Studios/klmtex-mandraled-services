<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index($id) {
        $product = Product::findOrFail($id);
        $attributes = $product->attributes;
        
        return view("products.attributes.index")->with([
            "product" => $product,
            "attributes" => $attributes
        ]);
    }

    public function store($id, Request $request) {
        $data = $request->validate([
            'title' => 'required|min:3|max:128',
            'value' => 'required|min:2|max:255',
            'product_id' => '',
        ]);

        $data['product_id'] = $id;

        Attribute::create([
            "product_id" => $data['product_id'],
            "title" => $data['title'],
            "value" => $data['value'],
            
        ]);

        if($request->submit == 'Save & Add One More Attribute') {
            return redirect(route('products.attributes.index', ['id'=> $id]))->with([
                "success" => "New product has been created"
            ]);
        } else if($request->submit == 'Save & Proceed to Next Step') {
            return redirect(route('products.offers.index', ['id'=> $id]))->with([
                "success" => "New product has been created"
            ]);
        }
    }

    public function delete($id, $aid) {
        $attribute = Attribute::findOrFail($aid);
        $attribute->delete();
        return redirect()->back()->with([
            "danger" => "Attribute has been removed"
        ]);
    }
}
