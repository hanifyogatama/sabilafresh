<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function __construct()
    {
        // parent::__construct();

        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = \Cart::getContent();
        $this->data['items'] = $items;

        return $this->load_theme('carts.index', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->except('_token');

        $product = Produk::findOrFail($params['produk_id']);
        $slug = $product->slug;

        // $attributes = [];

        // if ($product->configurable) {
        //     $product = Produk::from('produk as p')
        //         ->whereRaw("p.parent_id = :parent_produk_id
        //     and (select pav.text_value 
        //             from atribut_produk pav
        //             join atribut a on a.id = pav.atribut_id
        //             where a.kode = :size_code
        //             and pav.produk_id = p.id
        //             limit 1
        //         ) = :size_value
        //     and (select pav.text_value 
        //             from  atribut_produk pav
        //             join atribut a on a.id = pav.atribut_id
        //             where a.kode = :color_code
        //             and pav.produk_id = p.id
        //             limit 1
        //         ) = :color_value
        //         ", [
        //             'parent_produk_id' => $product->id,
        //             'size_code' => 'size',
        //             'size_value' => $params['size'],
        //             'color_code' => 'color',
        //             'color_value' => $params['color'],
        //         ])->firstOrFail();

        //     $attributes['size'] = $params['size'];
        //     $attributes['color'] = $params['color'];
        // }


        $item = [
            'id' => md5($product->id),
            'name' => $product->nama,
            'price' => $product->harga,
            'quantity' => $params['qty'],
            // 'attributes' => $attributes,
            'associatedModel' => $product,
        ];

        \Cart::add($item);

        
        \Session::flash('success', 'Produk ' . $item['name'] . ' has been added to cart');
        return redirect('/product/' . $slug);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $params = $request->except('_token');

        if ($items = $params['items']) {
            foreach ($items as $cartID => $item) {
                \Cart::update($cartID, [
                    'quantity' => [
                        'relative' => false,
                        'value' => $item['quantity'],
                    ],
                ]);
            }

            // \Session::flash('success', 'jumlah barang terupdate');
            return redirect('carts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        \Cart::remove($id);

        return redirect('carts');
    }
}
