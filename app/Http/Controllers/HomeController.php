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

        // $products = Produk::popular()->get();
        // $this->data['products'] = $products;

        $slides = GambarSlide::active()->orderBy('id', 'ASC')->get();
        $this->data['slides'] = $slides;

        $this->data['categories'] = Kategori::parentCategories()
            ->orderBy('id', 'asc')
            ->get();

        return $this->load_theme('home',$this->data);
    }
}
