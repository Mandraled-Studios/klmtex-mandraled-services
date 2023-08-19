<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VariantValue extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql2';
    public $timestamps = false;
}
