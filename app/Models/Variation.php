<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Enums\VariationSizeEnum;
use App\Models\Enums\VariationColourEnum;
use App\Traits\Uuids;

class Variation extends Model
{
    use HasFactory;
    use Uuids;
    protected $fillable = ['id', 'price', 'image', 'size', 'colour', 'stock'];
    protected $casts = [
        'size' => VariationSizeEnum::class,
        'colour' => VariationColourEnum::class,
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function getPriceStringAttribute()
    {
        return sprintf('%0.2f', $this->price);
    }
}
