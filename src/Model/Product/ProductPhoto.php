<?php

namespace Sajadsdi\Marketplace\Model\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Sajadsdi\Marketplace\Model\Product\Product;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','path','disk'];

    protected $appends  = ["url"];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->path);
    }
}
