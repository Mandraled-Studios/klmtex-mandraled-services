<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Highlight extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $connection = 'mysql2';

    protected $fillable = [
        'product_id', 'icon', 'highlight'
    ];

    /**
     * Get the product that owns the Highlight
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
