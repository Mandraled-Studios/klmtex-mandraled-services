<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function index($id) {
        $product = Product::findOrFail($id);
        $attachments = $product->attachments;
        return view("products.attachments.index")->with([
            "product" => $product,
            "attachments" => $attachments
        ]);
    }

    public function store($id, Request $request) {
        $data = $request->validate([
            'prodImage' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'prodVideo' => 'nullable|sometimes|min:4',
            'prodFile' => 'nullable|sometimes|file|mimes:pdf,ppt,doc,docx,xls,txt,png,jpg,svg',
            'prodURL' => 'nullable|sometimes|url|min:4|max:255',
            'attachment_type' => 'nullable|sometimes|min:2|max:255',
            'setting1' => '',
            'setting2' => '',
            'setting3' => '',
            'product_id' => '',
        ]);

        //dd($data['attachment_type']);

        $product_slug = Product::findOrFail($id)->slug;

        $data['product_id'] = $id;

        if($data['attachment_type'] == "prodImage") {

            if($request->hasFile('prodImage')) {
                //Get full filename with extension
                $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $product_slug), 0, 20)."-".random_int(1000,9999);      
                //Get extension of file
                $extension =  $request->file('prodImage')->getClientOriginalExtension(); 
                //Filename to store in DB
                $filenameToStore = $filename. "." . $extension;
                //Upload image to storage
                $imagePath = $request->file('prodImage')->storeAs('public/images/products/slideshow/', $filenameToStore);
                $data['file'] = "/storage/images/products/slideshow/" . $filenameToStore;
            }

            if(isset($request->setting1)) {
                $data['setting1'] = $request->setting1;
            } else {
                $data['setting1'] = NULL;
            }

            if(isset($request->setting2)) {
                $data['setting2'] = $request->setting2;
            } else {
                $data['setting2'] = NULL;
            }

            if(isset($request->setting3)) {
                $data['setting3'] = $request->setting3;
            } else {
                $data['setting3'] = NULL;
            }
        }

        if($data['attachment_type'] == "prodVideo") {
            
            $data['file'] = $data['prodVideo'];
            
            if(isset($request->setting4)) {
                $data['setting1'] = $request->setting4;
            } else {
                $data['setting1'] = NULL;
            }

            if(isset($request->setting5)) {
                $data['setting2'] = $request->setting5;
            } else {
                $data['setting2'] = NULL;
            }

            if(isset($request->setting6)) {
                $data['setting3'] = $request->setting6;
            } else {
                $data['setting3'] = NULL;
            }
        }

        if($data['attachment_type'] == "prodFile") {

            if($request->hasFile('prodFile')) {
                //Get full filename with extension
                $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $product_slug), 0, 20)."-".random_int(1000,9999);      
                //Get extension of file
                $extension =  $request->file('prodFile')->getClientOriginalExtension(); 
                //Filename to store in DB
                $filenameToStore = $filename. "." . $extension;
                //Upload image to storage
                $imagePath = $request->file('prodFile')->storeAs('public/attachments/products/', $filenameToStore);
                $data['file'] = "/storage/attachments/products/" . $filenameToStore;
            }

            if(isset($request->setting7)) {
                $data['setting1'] = $request->setting7;
            } else {
                $data['setting1'] = NULL;
            }

            if(isset($request->setting8)) {
                $data['setting2'] = $request->setting8;
            } else {
                $data['setting2'] = NULL;
            }

            if(isset($request->setting9)) {
                $data['setting3'] = $request->setting9;
            } else {
                $data['setting3'] = NULL;
            }
        }

        if($data['attachment_type'] == "prodURL") {

            $data['file'] = $data['prodURL'];

            if(isset($request->setting10)) {
                $data['setting1'] = $request->setting10;
            } else {
                $data['setting1'] = NULL;
            }

            if(isset($request->setting11)) {
                $data['setting2'] = $request->setting11;
            } else {
                $data['setting2'] = NULL;
            }

            if(isset($request->setting12)) {
                $data['setting3'] = $request->setting12;
            } else {
                $data['setting3'] = NULL;
            }
        }

        

        Attachment::create([
            "product_id" => $data['product_id'],
            "attachment_type" => $data['attachment_type'],
            "file" => $data['file'],   
            "setting1" => $data['setting1'],   
            "setting2" => $data['setting2'],   
            "setting3" => $data['setting3'],   
        ]);


        if($request->submit == 'Save & Add One More Attachment') {
            return redirect(route('products.attachments.index', ['id' => $id]))->with([
                "success" => "Attachment has been created"
            ]);
        } else if($request->submit == 'Save & Complete') {
            return redirect(route('products'))->with([
                "success" => "Attachment has been created"
            ]);
        }
    }

    public function delete($id, Request $request) {
        $atid = $request->attachmentId;
        $attachment = Attachment::findOrFail($atid);
        $attachment->delete();
        return redirect()->back()->with([
            "danger" => "Attachment has been removed"
        ]);
    }
}
