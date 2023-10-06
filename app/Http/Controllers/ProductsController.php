<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Enums\VariationSizeEnum;
use App\Models\Enums\VariationColourEnum;

class ProductsController extends Controller
{
    /**
     * Display the products list.
     */
    public function list(Request $request): View
    {
        $products = Product::with('variations')->get();

        return view('products.list', [
            'products' => $products,
        ]);
    }
    /**
     * Display the product details.
     */
    public function details(int $id): View
    {
        $product = Product::with('variations')->findOrFail($id);
        $product->variationsJSON = $product->variations->map(function($i){ return ['id' => $i->id, 'size' => $i->size, 'colour' => $i->colour, 'price' => $i->price, 'image' => $i->image]; });
        return view('products.details', [
            'product' => $product,
            'sizes' => VariationSizeEnum::values(),
            'colours' => VariationColourEnum::values(),
        ]);
    }

}
