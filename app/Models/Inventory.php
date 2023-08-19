<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $connection = 'mysql2';
    protected $table = "products_sku";
    public $timestamps = false;

    protected $fillable = ["sku_code", "max_price", "offer_price", 
                           "total_stock", "package_type", "length", 
                           "breadth", "height", "weight", "dimension_unit", 
                           "weight_unit", "product_id", "is_active"];
}
