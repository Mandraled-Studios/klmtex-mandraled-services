<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSKUVariant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mysql2';
    protected $table = "products_sku_variant";
    public $timestamps = false;

    protected $fillable = [
        'products_sku_id', 'variant_id', 'variant_value_id'
    ];
}
