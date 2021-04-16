<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\Category;

use Str;

class ProductController extends Controller
{

    public function __construct()
    {
        // parent::__construct();

        $this->data['q'] = null;

        $this->data['categories'] = Category::parentCategories()
            ->orderBy('nama', 'asc')
            ->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $products = Product::active();

        if ($q = $request->query('q')) {
            $q = str_replace('-', ' ', Str::slug($q));

            $products = $products->whereRaw('MATCH(nama, slug, deskripsi, detail_deskripsi) AGAINST (? IN NATURAL LANGUAGE MODE)', [$q]);

            $this->data['q'] = $q;
        }

        if ($categorySlug = $request->query('category')) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();

            $childIds = Category::childIds($category->id);
            $categoryIds = array_merge([$category->id], $childIds);


            
            $products = $products->whereHas('kategori', function ($query) use ($categoryIds) {
                $query->whereIn('kategori.id', $categoryIds);
            });
        }

        $this->data['products'] = $products->paginate(10);

        return $this->load_theme('products.index', $this->data);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::active()->where('slug', $slug)->first();

        if (!$product) {
            return redirect('products');
        }

        if ($product->type == 'configurable') {
            $this->data['colors'] = ProductAttributeValue::getAttributeOptions($product, 'color')->pluck('text_value', 'text_value');
            $this->data['sizes'] = ProductAttributeValue::getAttributeOptions($product, 'size')->pluck('text_value', 'text_value');
        }

        $this->data['product'] = $product;

        return $this->load_theme('products.show', $this->data);
    }
}
