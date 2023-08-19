<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql2';
    public $timestamps = false;
    protected $fillable = ["name", "metatitle", "keywords", "slug", "description", "hero_img_path", "icon_path", "is_active"];

    public function secondary_subcategories()
    {
        return $this->hasOneThrough(SecondarySubcategory::class, Subcategory::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }

}
