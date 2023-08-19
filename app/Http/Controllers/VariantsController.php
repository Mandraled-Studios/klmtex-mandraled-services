<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class VariantsController extends Controller
{
    public function index($id) {
        $hasVariants = false;
        $product = Product::findOrFail($id);
        if($product->variants != NULL) {
            $hasVariants = true;
        }
        return view('products.variants.index')->with([
            "product" => $product,
            "hasVariants" => $hasVariants
        ]);
    }

    public function create($id) {
        $product = Product::findOrFail($id);
        return view('products.variants.create')->with([
            "product" => $product
        ]);
    }

    public function store($id, Request $request) {
        $data = $request->validate([
            'submit' => 'required'
        ]);

        if($data['submit'] == 'Save & Quit') {
            return redirect(route('products'))->with([
                "success" => "New product has been created"
            ]);
        } else if($data['submit'] == 'Save & Proceed to Next Step') {
            return redirect(route('products.stock.index', ['id' => $id]))->with([
                "success" => "New product has been created"
            ]);
        }
    }

    public function edit() {
        return view('products.variants.edit');
    }

    public function update() {
        
    }

    public function delete() {
        
    }

}
