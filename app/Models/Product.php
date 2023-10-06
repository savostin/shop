<?php

namespace App\Models;

use App\Models\Variation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'image'];
    protected $appends = ['price'];

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function getPriceAttribute()
    {
        return $this->variations->min('price');
    }
    public function getPriceStringAttribute()
    {
        return sprintf('%0.2f', $this->price);
    }
}
