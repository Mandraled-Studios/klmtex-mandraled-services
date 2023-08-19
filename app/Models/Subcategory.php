<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql2';
    public $timestamps = false;
    protected $fillable = ["name", "metatitle", "keywords", "slug", "description", "hero_img_path", "icon_path", "is_active", "category_id"];

    public function secondary_subcategories()
    {
        return $this->hasMany(SecondarySubcategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }

}
