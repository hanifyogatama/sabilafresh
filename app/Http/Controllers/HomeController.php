<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\GambarSlide;
use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $products = Produk::active();

        // ----------------------------------------------------------------------------- EDIT DI SINI

        // $popularProducts = Produk::popular()->get();
        // $this->data['popularProducts'] = $popularProducts;

        $slides = GambarSlide::active()->orderBy('id', 'ASC')->get();
        $this->data['slides'] = $slides;

        $this->data['categories'] = Kategori::parentCategories()
            ->orderBy('id', 'asc')
            ->get();

        $this->data['products'] = $products->orderBy('created_at', 'desc')->get();

        return $this->load_theme('home', $this->data);
    }
}
