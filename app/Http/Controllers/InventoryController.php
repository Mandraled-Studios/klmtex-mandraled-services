<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\ProductSKUVariant;

class InventoryController extends Controller
{
    public function index($id) {
        $product = Product::findOrFail($id);
        return view("products.inventory.index")->with([
            "product" => $product,
            "title" => "Inventory"
        ]);
    }

    public function create($id) {
        $product = Product::findOrFail($id);
        $skus = $product->skus;
        return view("products.inventory.create")->with([
            "product" => $product,
            "skus" => $skus,
            "title" => "Manage SKUs for Product"
        ]);
    }

    public function store($id, Request $request) {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'sku_code' => 'required|min:3',
            'total_stock' => 'required|numeric|min:0',
            'max_price' => 'required|numeric|min:0',
            'offer_price' => 'required|numeric|min:0',
            'package_type' => 'required',
            'length' => 'nullable|sometimes|numeric|min:0',
            'breadth' => 'nullable|sometimes|numeric|min:0',
            'height' => 'nullable|sometimes|numeric|min:0',
            'dimension_unit' => 'nullable|sometimes',
            'weight' => 'nullable|sometimes|numeric|min:0',
            'weight_unit' => 'nullable|sometimes',
            'is_stock_monitored' => '',
            "variant"    => "required|array|min:1",
            "variant.*"  => "required|string",
            "variantValue"    => "required|array|min:1",
            "variantValue.*"  => "required|string",
        ]);

        if(isset($data['is_stock_monitored'])) {
            $data['is_active'] = 1;
        } else {
            $data['is_active'] = 0;
        }

        $data['product_id'] = $product->id;

        $newVariantValues = array();

        foreach($data['variant'] as $variantID) {
            //Loop through 59, 60, 61
            $variant = Variant::findOrFail($variantID);
            
            foreach($variant->variantValues as $varVals) {
                //Loop through 111, 112 for 59 | 
                $key = array_search($varVals->id, $data['variantValue']);
                // Find if 111 is present among 111, 115, 116

                if($key !== false) {
                    $newVariantValues[$variantID] = $data['variantValue'][$key];
                }
            }
        }
    
        $new_product_sku = Inventory::create($data);

        $mydata = array();

        foreach($newVariantValues as $mykey => $vv) {
            array_push($mydata, [
                'products_sku_id' => $new_product_sku->id, 
                'variant_id' => $mykey, 
                'variant_value_id'=> $vv
            ]);  
        }

        ProductSKUVariant::insert($mydata);

        if($request->submit == 'Save SKU Details') {
            return redirect(route('products.highlights.index'))->with([
                "success" => "New SKU has been added"
            ]);
        } else if($request->submit == 'Save & Add New SKU Details') {
            return redirect(route('products.stock.create', ['id' => $id]))->with([
                "success" => "New SKU has been added"
            ]);
        }
    }
}
