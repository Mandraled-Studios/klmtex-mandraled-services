<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSKU extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $connection = 'mysql2';
    protected $table = "products_sku";
    public $timestamps = false;
    protected $fillable = [
        'sku_code', 'max_price', 'offer_price', 'tax_inclusive', 'upc_number', 'total_stock', 
        'ordered_stock', 'threshold_stock', 'returned_stock', 'package_type', 'length', 'breadth', 
        'height', 'weight', 'dimension_unit', 'weight_unit', 'availability', 'is_active'
    ];

    /**
     * Get the product that owns the ProductSKU
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
