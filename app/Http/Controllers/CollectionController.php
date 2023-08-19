<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index() {
        return view("collections.index")->with([
            "title" => "Collections"
        ]);
    }

    public function create() {
        return view("collections.create")->with([
            "title" => "Create Collection"
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|min:2|max:128',
            'slug' => 'required|max:128',
            'hero' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'icon' => 'nullable|sometimes|image|mimes:png,jpg,svg',
            'isActive' => '',
        ]);

        return redirect(route('collections'))->with([
            "success" => "New collection has been created"
        ]);
    }
}
