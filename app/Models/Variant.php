<?php

namespace App\Models;

use App\Models\VariantValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variant extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql2';
    public $timestamps = false;
    protected $fillable = ["name", "product_id", "sort_order"];

    public function variantValues() {
        return $this->hasMany(VariantValue::class);
    }
}
