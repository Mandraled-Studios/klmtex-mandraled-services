<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index($id) {
        $product = Product::findOrFail($id);
        $offers = $product->offers;
        return view("products.offers.index")->with([
            "product" => $product,
            "offers" => $offers,
        ]);
    }

    public function store($id, Request $request) {
        $data = $request->validate([
            'title' => 'required|min:4|max:128',
            'details' => 'required|min:4|max:255',
            'disclaimer' => 'nullable|sometimes|min:4|max:128',
            'link' => 'nullable|sometimes|min:4|max:255',
            'icon' => 'nullable|sometimes|image|mimes:jpg,jpeg,png,gif,svg',
            'product_id' => '',
        ]);

        $data['product_id'] = $id;

        if($request->hasFile('icon')) {
            //Get full filename with extension
            $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $data['title']), 0, 20)."-".random_int(1000,9999);      
            //Get extension of file
            $extension =  $request->file('icon')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename. "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('icon')->storeAs('public/images/icons/offers/', $filenameToStore);
            $data['icon'] = "/storage/images/icons/offers/" . $filenameToStore;
        } else {
            $data['icon'] = NULL;
        }

        Offer::create([
            "product_id" => $data['product_id'],
            "title" => $data['title'],
            "details" => $data['details'],
            "disclaimer" => $data['disclaimer'],
            "link" => $data['link'],
            "icon" => $data['icon'],
            
        ]);


        if($request->submit == 'Save & Add One More Offer') {
            return redirect(route('products.offers.index', ['id' => $id]))->with([
                "success" => "Offer has been created"
            ]);
        } else if($request->submit == 'Save & Proceed to Next Step') {
            return redirect(route('products.attachments.index', ['id' => $id]))->with([
                "success" => "Offer has been created"
            ]);
        }
    }

    public function delete($id, $oid) {
        $offer = Offer::findOrFail($oid);
        $offer->delete();
        return redirect()->back()->with([
            "danger" => "Offer has been removed"
        ]);
    }
}
