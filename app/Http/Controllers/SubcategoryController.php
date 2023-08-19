<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    public function index() {
        $subcategories = DB::connection('mysql2')->table('subcategories')
                            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
                            ->select('subcategories.*', 'categories.name AS categoryName')
                            ->whereNull('subcategories.deleted_at')
                            ->get();
        return view("subcategories.index")->with([
            "subcategories" => $subcategories
        ]);
    }

    public function create() {
        $categories = Category::all();
        return view("subcategories.create")->with([
            "categories" => $categories
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|min:2|max:128',
            'metatitle' => 'nullable|sometimes|max:128',
            'keywords' => 'nullable|sometimes|max:255',
            'slug' => 'required|max:128|unique:mysql2.subcategories,slug',
            'description' => 'nullable|sometimes|min:5',
            'hero' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'icon' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'isActive' => '',
            'category' => 'required'
        ]);

        if($request->hasFile('icon')) {
            //Get full filename with extension
            $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $data['slug']), 0, 20)."-".random_int(1000,9999);      
            //Get extension of file
            $extension =  $request->file('icon')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename. "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('icon')->storeAs('public/icons/subcategories/', $filenameToStore);
            $data['icon_path'] = "/storage/icons/subcategories/" . $filenameToStore;
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
            $imagePath = $request->file('hero')->storeAs('public/images/banners/subcategories/', $filenameToStore);
            $data['hero_img_path'] = "/storage/images/banners/subcategories/" . $filenameToStore;
        } else {
            $data['hero_img_path'] = NULL;
        }

        if(isset($request->isActive)) {
            $data['isActive'] = true;
        } else {
            $data['isActive'] = false;
        }

        Subcategory::create([
            "name" => $data['name'],
            "metatitle" => $data['metatitle'],
            "keywords" => $data['keywords'],
            "slug" => $data['slug'],
            "description" => $data['description'],
            "hero_img_path" => $data['hero_img_path'],
            "icon_path" => $data['icon_path'],
            "is_active" => $data['isActive'],
            "category_id" => $data['category'],
        ]);

        return redirect(route('subcategories'))->with([
            "success" => "New subcategory has been created"
        ]);
    }

    public function edit($subcat) {
        $categories = Category::all();
        $subcategory = Subcategory::findOrFail($subcat);
        
        return view("subcategories.edit")->with([
            "categories" => $categories,
            "subcategory" => $subcategory,
        ]);
    }

    public function update($subcat, Request $request) {
        $subcategory = Subcategory::findOrFail($subcat);
        $data = $request->validate([
            'name' => 'required|min:2|max:128',
            'metatitle' => 'nullable|sometimes|max:128',
            'keywords' => 'nullable|sometimes|max:255',
            'slug' => 'required|max:128|unique:mysql2.subcategories,slug,'.$subcat,
            'description' => 'nullable|sometimes|min:5',
            'hero' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'icon' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'isActive' => '',
            'category' => 'required'
        ]);

        if($request->hasFile('icon')) {
            //Get full filename with extension
            $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $data['slug']), 0, 20)."-".random_int(1000,9999);      
            //Get extension of file
            $extension =  $request->file('icon')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename. "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('icon')->storeAs('public/icons/subcategories/', $filenameToStore);
            $data['icon_path'] = "/storage/icons/subcategories/" . $filenameToStore;
        } else {
            if($subcategory->icon_path != NULL) {
                $data['icon_path'] = $subcategory->icon_path;
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
            $imagePath = $request->file('hero')->storeAs('public/images/banners/subcategories/', $filenameToStore);
            $data['hero_img_path'] = "/storage/images/banners/subcategories/" . $filenameToStore;
        } else {
            if($subcategory->hero_img_path != NULL) {
                $data['hero_img_path'] = $subcategory->hero_img_path;
            } else {
                $data['hero_img_path'] = NULL;
            }
        }

        if(isset($request->isActive)) {
            $data['isActive'] = true;
        } else {
            $data['isActive'] = false;
        }

        $subcategory->update([
            "name" => $data['name'],
            "metatitle" => $data['metatitle'],
            "keywords" => $data['keywords'],
            "slug" => $data['slug'],
            "description" => $data['description'],
            "hero_img_path" => $data['hero_img_path'],
            "icon_path" => $data['icon_path'],
            "is_active" => $data['isActive'],
            "category_id" => $data['category'],
        ]);

        return redirect(route('subcategories'))->with([
            "success" => "Sub Category has been updated"
        ]);
    }

    public function delete($subcat) {
        $subcategory = Subcategory::findOrFail($subcat);
        $subcategory->delete();
        return redirect(route('subcategories'))->with([
            "danger" => "Sub Category has been removed"
        ]);
    }

    public function search(Request $request) {
        $subcategories = Subcategory::where('name', 'like', '%'.$request->term.'%')->get();
        return view("subcategories.index")->with([
            "subcategories" => $subcategories,
            "term" => $request->term
        ]);;
    }

}
