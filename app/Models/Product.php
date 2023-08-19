<?php

namespace App\Models;

use App\Models\Offer;
use App\Models\Banner;
use App\Models\Attribute;
use App\Models\Attachment;
use App\Models\ProductSKU;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql2';
    public $timestamps = false;
    protected $fillable = [ "name", "metatitle", "keywords", "slug", "short_description", 
                            "long_description", "thumbnail_path", "tag1", "tag2", 
                            "is_active", "has_variants", "is_stock_monitored", "has_highlights", "has_banner", 
                            "has_attributes", "has_offers", "has_attachments", "allows_questions", 
                            "tax_slab", "features", "productable_id", "productable_type"
                          ];

    public function productable()
    {
        return $this->morphTo();
    }

    public function variants() {
        return $this->hasMany(Variant::class);
    }

    /**
     * Get all of the skus for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skus(): HasMany
    {
        return $this->hasMany(ProductSKU::class, 'product_id');
    }

    /**
     * Get all of the highlights for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function highlights(): HasMany
    {
        return $this->hasMany(Highlight::class);
    }

    /**
     * Get all of the banners for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function banners(): HasMany
    {
        return $this->hasMany(Banner::class);
    }

    /**
     * Get all of the attributes for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }

    /**
     * Get all of the offers for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    /**
     * Get all of the attachments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }


}
