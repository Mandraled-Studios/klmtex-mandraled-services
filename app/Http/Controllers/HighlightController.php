<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Highlight;
use Illuminate\Http\Request;

class HighlightController extends Controller
{
    public function index($id) {
        $product = Product::findOrFail($id);
        $highlights = $product->highlights;
        return view("products.highlights.index")->with([
            "product" => $product,
            "highlights" => $highlights
        ]);
    }

    public function store($id, Request $request) {
        $data = $request->validate([
            'highlight' => 'required|min:4|max:255',
            'icon' => 'required|image|mimes:png,jpg,svg',
            'product_id' => '',
        ]);

        $data['product_id'] = $id;

        if($request->hasFile('icon')) {
            //Get full filename with extension
            $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $data['highlight']), 0, 20)."-".random_int(1000,9999);      
            //Get extension of file
            $extension =  $request->file('icon')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename. "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('icon')->storeAs('public/icons/highlights/', $filenameToStore);
            $data['icon'] = "/storage/icons/highlights/" . $filenameToStore;
        } else {
            $data['icon'] = NULL;
        }

        Highlight::create([
            "product_id" => $data['product_id'],
            "highlight" => $data['highlight'],
            "icon" => $data['icon'],
        ]);


        if($request->submit == 'Save & Add One More Highlight') {
            return redirect(route('products.highlights.index', ['id' => $id]))->with([
                "success" => "Highlight has been created"
            ]);
        } else if($request->submit == 'Save & Proceed to Next Step') {
            return redirect(route('products.banners.index', ['id' => $id]))->with([
                "success" => "Highlight has been created"
            ]);
        }
    }

    public function delete($id, $hid) {
        $highlight = Highlight::findOrFail($hid);
        $highlight->delete();
        return redirect()->back()->with([
            "danger" => "Highlight has been removed"
        ]);
    }
}
