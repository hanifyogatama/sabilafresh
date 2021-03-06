<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\AtributProduk;
use App\Models\Kategori;

use Str;
use Symfony\Component\VarDumper\VarDumper;

class ProductController extends Controller
{

    public function __construct()
    {
        // parent::__construct();

        $this->data['q'] = null;

        $this->data['categories'] = Kategori::parentCategories()
            ->orderBy('nama', 'asc')
            ->get();

        // sorting by price
        $this->data['minPrice'] = Produk::min('harga');
        $this->data['maxPrice'] = Produk::max('harga');

        // sorting
        $this->data['sorts'] = [
            url('products') => 'Default',
            url('products?sort=harga-asc') => 'Harga - Rendah ke Tinggi',
            url('products?sort=harga-desc') => 'Harga - Tinggi ke Rendah',
            url('products?sort=created_at-asc') => 'Produk - Lama ke Batu',
            url('products?sort=created_at-desc') => 'Produk - Baru ke lama',
        ];

        $this->data['selectedSort'] = url('products');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



        $products = Produk::active();

        $products = $this->searchProducts($products, $request);
        $products = $this->filterProductByPriceRange($products, $request);
        $products = $this->sortProducts($products, $request);

        $this->data['products'] = $products->paginate(16);

        return $this->load_theme('products.index', $this->data);
    }

    private function searchProducts($products, $request)
    {
        if ($q = $request->query('q')) {
            $q = str_replace('-', ' ', Str::slug($q));

            $products = $products->whereRaw('MATCH(nama, slug, deskripsi, detail_deskripsi) AGAINST (? IN NATURAL LANGUAGE MODE)', [$q]);

            $this->data['q'] = $q;
        }

        if ($categorySlug = $request->query('category')) {
            $category = Kategori::where('slug', $categorySlug)->firstOrFail();

            $childIds = Kategori::childIds($category->id);
            $categoryIds = array_merge([$category->id], $childIds);


            $products = $products->whereHas('kategories', function ($query) use ($categoryIds) {
                $query->whereIn('kategori.id', $categoryIds);
            });
        }

        return $products;
    }

    private function filterProductByPriceRange($products, $request)
    {
        $lowPrice = null;
        $highPrice = null;

        if ($priceSlider = $request->query('harga')) {
            $prices = explode('-', $priceSlider);

            $lowPrice = !empty($prices[0]) ? (float)$prices[0] : $this->data['minPrice'];
            $highPrice = !empty($prices[1]) ? (float)$prices[1] : $this->data['maxPrice'];

            if ($lowPrice && $highPrice) {
                $products = $products->where('harga', '>=', $lowPrice)
                    ->where('harga', '<=', $highPrice);
                    
                $this->data['minPrice'] = $lowPrice;
                $this->data['maxPrice'] = $highPrice;
            }
        }

        return $products;
    }

    private function sortProducts($products, $request)
    {
        if ($sort = preg_replace('/\s+/', '', $request->query('sort'))) {
            $availableSorts = ['harga', 'created_at'];
            $availableOrder = ['asc', 'desc'];
            $sortAndOrder = explode('-', $sort);

            $sortBy = strtolower($sortAndOrder[0]);
            $orderBy = strtolower($sortAndOrder[1]);

            if (in_array($sortBy, $availableSorts) && in_array($orderBy, $availableOrder)) {
                $products = $products->orderBy($sortBy, $orderBy);
            }

            $this->data['selectedSort'] = url('products?sort=' . $sort);
        }

        return $products;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Produk::active()->where('slug', $slug)->first();

        if (!$product) {
            return redirect('products');
        }

        // if ($product->type == 'configurable') {
        //     $this->data['colors'] = AtributProduk::getAttributeOptions($product, 'color')->pluck('text_value', 'text_value');
        //     $this->data['sizes'] = AtributProduk::getAttributeOptions($product, 'size')->pluck('text_value', 'text_value');
        // }

        $this->data['product'] = $product;

        return $this->load_theme('products.show', $this->data);
    }
}
