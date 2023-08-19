<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SecondarySubCategory;

class APIController extends Controller
{
    public function loadCategoryOptions() {     
        $result = Category::all();
        return $result;
    }

    public function loadSubCategoryOptions() {     
        $result = Subcategory::all();
        return $result;
    }

    public function loadSubcategoryOptionsUnder($cat) {     
        $result = Subcategory::where('category_id', $cat)->get();
        return $result;
    }

    public function loadSecondarySubcategoryOptions() {     
        $result = SecondarySubcategory::all();
        return $result;
    }

    public function loadSecondarySubcategoryOptionsUnder($subcat) {     
        $result = SecondarySubcategory::where('subcategory_id', $subcat)->get();
        return $result;
    }
}
