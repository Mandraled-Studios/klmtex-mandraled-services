<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = "companies";

    protected $fillable = ["company_name", "gstin", "address_id", 
                           "logo", "invoice_terms", "quote_terms", 
                           "payment_terms", "signature"];
                        
    public function address() {
        return $this->belongsTo(Address::class);
    }
}
