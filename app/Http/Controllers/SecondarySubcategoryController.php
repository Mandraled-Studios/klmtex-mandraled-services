<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SecondarySubcategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SecondarySubcategoryController extends Controller
{
    public function index() {
        $sec_subcategories = DB::connection('mysql2')->table('secondary_subcategories')
                            ->join('subcategories', 'secondary_subcategories.subcategory_id', '=', 'subcategories.id')
                            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
                            ->select('secondary_subcategories.*', 'subcategories.name AS subcatName', 'categories.name AS categoryName')
                            ->whereNull('secondary_subcategories.deleted_at')
                            ->get();
        return view("secsubcategories.index")->with([
            "sec_subcategories" => $sec_subcategories
        ]);
    }

    public function create() {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view("secsubcategories.create")->with([
            "categories" => $categories,
            "subcategories" => $subcategories,
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|min:2|max:128',
            'metatitle' => 'nullable|sometimes|max:128',
            'keywords' => 'nullable|sometimes|max:255',
            'slug' => 'required|max:128|unique:mysql2.secondary_subcategories,slug',
            'description' => 'nullable|sometimes|min:5',
            'hero' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'icon' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'isActive' => '',
            'subcategory' => 'required'
        ]);

        if($request->hasFile('icon')) {
            //Get full filename with extension
            $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $data['slug']), 0, 20)."-".random_int(1000,9999);      
            //Get extension of file
            $extension =  $request->file('icon')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename. "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('icon')->storeAs('public/icons/secondary-subcategories/', $filenameToStore);
            $data['icon_path'] = "/storage/icons/secondary-subcategories/" . $filenameToStore;
        } else {
            $data['icon_path'] = NULL;
        }

        if($request->hasFile('hero')) {
            //Get full filename with extension
            $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $data['slug']), 0, 20)."-".random_int(1000,9999);      
            //Get extension of file
            $extension =  $request->file('hero')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename. "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('hero')->storeAs('public/images/banners/secondary-subcategories/', $filenameToStore);
            $data['hero_img_path'] = "/storage/images/banners/secondary-subcategories/" . $filenameToStore;
        } else {
            $data['hero_img_path'] = NULL;
        }

        if(isset($request->isActive)) {
            $data['isActive'] = true;
        } else {
            $data['isActive'] = false;
        }

        SecondarySubcategory::create([
            "name" => $data['name'],
            "metatitle" => $data['metatitle'],
            "keywords" => $data['keywords'],
            "slug" => $data['slug'],
            "description" => $data['description'],
            "hero_img_path" => $data['hero_img_path'],
            "icon_path" => $data['icon_path'],
            "is_active" => $data['isActive'],
            "subcategory_id" => $data['subcategory'],
        ]);

        return redirect(route('secondary-subcategories'))->with([
            "success" => "New secondary subcategory has been created"
        ]);
    }

    public function edit($secsubcat) {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $sec_subcategory = SecondarySubcategory::findOrFail($secsubcat);
        $chosenCategory = Subcategory::find($sec_subcategory->subcategory_id)->category_id;
       
        return view("secsubcategories.edit")->with([
            "categories" => $categories,
            "subcategories" => $subcategories,
            "chosenCategory" => $chosenCategory,
            "sec_subcategory" => $sec_subcategory,
        ]);
    }

    public function update($secsubcat, Request $request) {
        $sec_subcategory = SecondarySubcategory::findOrFail($secsubcat);
        $data = $request->validate([
            'name' => 'required|min:2|max:128',
            'metatitle' => 'nullable|sometimes|max:128',
            'keywords' => 'nullable|sometimes|max:255',
            'slug' => 'required|max:128|unique:mysql2.secondary_subcategories,slug,'.$secsubcat,
            'description' => 'nullable|sometimes|min:5',
            'hero' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'icon' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'isActive' => '',
            'subcategory' => 'required'
        ]);

        if($request->hasFile('icon')) {
            //Get full filename with extension
            $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $data['slug']), 0, 20)."-".random_int(1000,9999);      
            //Get extension of file
            $extension =  $request->file('icon')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename. "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('icon')->storeAs('public/icons/secondary-subcategories/', $filenameToStore);
            $data['icon_path'] = "/storage/images/icons/secondary-subcategories/" . $filenameToStore;
        } else {
            if($sec_subcategory->icon_path != NULL) {
                $data['icon_path'] = $sec_subcategory->icon_path;
            } else {
                $data['icon_path'] = NULL;
            }
        }

        if($request->hasFile('hero')) {
            //Get full filename with extension
            $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $data['slug']), 0, 20)."-".random_int(1000,9999);      
            //Get extension of file
            $extension =  $request->file('hero')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename. "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('hero')->storeAs('public/images/banners/secondary-subcategories/', $filenameToStore);
            $data['hero_img_path'] = "/storage/images/banners/secondary-subcategories/" . $filenameToStore;
        } else {
            if($sec_subcategory->hero_img_path != NULL) {
                $data['hero_img_path'] = $sec_subcategory->hero_img_path;
            } else {
                $data['hero_img_path'] = NULL;
            }
        }

        if(isset($request->isActive)) {
            $data['isActive'] = true;
        } else {
            $data['isActive'] = false;
        }

        $sec_subcategory->update([
            "name" => $data['name'],
            "metatitle" => $data['metatitle'],
            "keywords" => $data['keywords'],
            "slug" => $data['slug'],
            "description" => $data['description'],
            "hero_img_path" => $data['hero_img_path'],
            "icon_path" => $data['icon_path'],
            "is_active" => $data['isActive'],
            "subcategory_id" => $data['subcategory']
        ]);

        return redirect(route('secondary-subcategories'))->with([
            "success" => "Secondary Sub Category has been updated"
        ]);
    }

    public function delete($secsubcat) {
        $sec_subcategory = SecondarySubcategory::findOrFail($secsubcat);
        $sec_subcategory->delete();
        return redirect(route('secondary-subcategories'))->with([
            "danger" => "Secondary Sub Category has been removed"
        ]);
    }

    public function search(Request $request) {
        $sec_subcategories = SecondarySubcategory::where('name', 'like', '%'.$request->term.'%')->get();
        return view("secsubcategories.index")->with([
            "sec_subcategories" => $sec_subcategories,
            "term" => $request->term
        ]);;
    }
}
