<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view("categories.index")->with([
            "categories" => $categories,
        ]);
    }

    public function create() {
        return view("categories.create")->with([
            "title" => "Create Category"
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|min:2|max:128',
            'metatitle' => 'nullable|sometimes|max:128',
            'keywords' => 'nullable|sometimes|max:255',
            'slug' => 'required|max:128|unique:mysql2.categories,slug',
            'description' => 'nullable|sometimes|min:5',
            'hero' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'icon' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'isActive' => '',
        ]);

        if($request->hasFile('icon')) {
            //Get full filename with extension
            $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $data['slug']), 0, 20)."-".random_int(1000,9999);      
            //Get extension of file
            $extension =  $request->file('icon')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename. "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('icon')->storeAs('public/icons/categories/', $filenameToStore);
            $data['icon_path'] = "/storage/icons/categories/" . $filenameToStore;
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
            $imagePath = $request->file('hero')->storeAs('public/images/banners/categories/', $filenameToStore);
            $data['hero_img_path'] = "/storage/images/banners/categories/" . $filenameToStore;
        } else {
            $data['hero_img_path'] = NULL;
        }

        if(isset($request->isActive)) {
            $data['isActive'] = true;
        } else {
            $data['isActive'] = false;
        }

        Category::create([
            "name" => $data['name'],
            "metatitle" => $data['metatitle'],
            "keywords" => $data['keywords'],
            "slug" => $data['slug'],
            "description" => $data['description'],
            "hero_img_path" => $data['hero_img_path'],
            "icon_path" => $data['icon_path'],
            "is_active" => $data['isActive'],
        ]);

        return redirect(route('categories'))->with([
            "success" => "New category has been created"
        ]);
    }

    public function edit($cat) {
        $category = Category::findOrFail($cat);
        return view("categories.edit")->with([
            "category" => $category,
        ]);
    }

    public function update($cat, Request $request) {
        $category = Category::findOrFail($cat);
        $data = $request->validate([
            'name' => 'required|min:2|max:128',
            'metatitle' => 'nullable|sometimes|max:128',
            'keywords' => 'nullable|sometimes|max:255',
            'slug' => 'required|max:128|unique:mysql2.categories,slug,'.$cat,
            'description' => 'nullable|sometimes|min:5',
            'hero' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'icon' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'isActive' => '',
        ]);

        if($request->hasFile('icon')) {
            //Get full filename with extension
            $filename = substr(preg_replace('/[^A-Za-z0-9\-]/', '', $data['slug']), 0, 20)."-".random_int(1000,9999);      
            //Get extension of file
            $extension =  $request->file('icon')->getClientOriginalExtension(); 
            //Filename to store in DB
            $filenameToStore = $filename. "." . $extension;
            //Upload image to storage
            $imagePath = $request->file('icon')->storeAs('public/icons/categories/', $filenameToStore);
            $data['icon_path'] = "/storage/icons/categories/" . $filenameToStore;
        } else {
            if($category->icon_path != NULL) {
                $data['icon_path'] = $category->icon_path;
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
            $imagePath = $request->file('hero')->storeAs('public/images/banners/categories/', $filenameToStore);
            $data['hero_img_path'] = "/storage/images/banners/categories/" . $filenameToStore;
        } else {
            if($category->hero_img_path != NULL) {
                $data['hero_img_path'] = $category->hero_img_path;
            } else {
                $data['hero_img_path'] = NULL;
            }
        }

        if(isset($request->isActive)) {
            $data['isActive'] = true;
        } else {
            $data['isActive'] = false;
        }

        $category->update([
            "name" => $data['name'],
            "metatitle" => $data['metatitle'],
            "keywords" => $data['keywords'],
            "slug" => $data['slug'],
            "description" => $data['description'],
            "hero_img_path" => $data['hero_img_path'] ?? NULL,
            "icon_path" => $data['icon_path'] ?? NULL,
            "is_active" => $data['isActive'],
        ]);

        return redirect(route('categories'))->with([
            "success" => "Category has been updated"
        ]);
    }

    public function delete($cat) {
        $category = Category::findOrFail($cat);
        $category->delete();
        return redirect(route('categories'))->with([
            "danger" => "Category has been removed"
        ]);
    }

    public function search(Request $request) {
        $categories = Category::where('name', 'like', '%'.$request->term.'%')->get();
        return view("categories.index")->with([
            "categories" => $categories,
            "term" => $request->term
        ]);
    }
}
