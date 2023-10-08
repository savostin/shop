<?php

namespace App\Http\Controllers;

use App\Models\Enums\VariationColourEnum;
use App\Models\Enums\VariationSizeEnum;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function list(Request $request): View
    {
        $products = Product::with('variations')->whereHas('variations', function(Builder $query){
            $query->where('stock', '>', 0);
        })->get();

        return view('products.list', [
            'products' => $products,
        ]);
    }

    public function details(int $id): View
    {
        $product = Product::with('variations')->findOrFail($id);
        $product->variationsJSON = $product->variations->map(function ($i) {return [
            'id' => $i->id,
            'size' => $i->size,
            'colour' => $i->colour,
            'price' => $i->price,
            'image' => $i->image,
            'stock' => $i->stock,
        ];});
        return view('products.details', [
            'product' => $product,
            'sizes' => VariationSizeEnum::values(),
            'colours' => VariationColourEnum::values(),
        ]);
    }

}
