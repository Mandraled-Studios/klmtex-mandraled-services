<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $connection = 'mysql2';

    protected $fillable = [
        "product_id", "attachment_type", "file", 
        "setting1", "setting2", "setting3"
    ];

    /**
     * Get the product that owns the Attachment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
