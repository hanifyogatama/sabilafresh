<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorit;
use App\Models\Produk;

class FavoriteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favorites = Favorit::where('user_id', \Auth::user()->id)
            ->orderBy('created_at', 'desc')->paginate(10);

        $this->data['favorites'] = $favorites;

        return $this->load_theme('favorites.index', $this->data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'product_slug' => 'required',
            ]
        );

        $product = Produk::where('slug', $request->get('product_slug'))->firstOrFail();

        $favorite = Favorit::where('user_id', \Auth::user()->id)
            ->where('produk_id', $product->id)
            ->first();
        if ($favorite) {
            return response('kamu sudah menambahkan barang ini sebelumnya', 422);
        }

        Favorit::create(
            [
                'user_id' => \Auth::user()->id,
                'produk_id' => $product->id,
            ]
        );

        return response('Produk berhasil ditambahkan ke wishlist', 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $favorite = Favorit::findOrfail($id);
        $favorite->delete();

        return redirect('favorites')->with('remove-wishlist', 'success');
    }
}
