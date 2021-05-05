<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Pemesanan;
use App\Models\Role;
use App\Models\Permission;


class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        $customers = User::where('is_admin', '==', 0)->orderBy('created_at', 'desc')->get();
        $admins = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'Admin');
            }
        )->get();

        $owners = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'Owner');
            }
        )->get();

        $categories = Kategori::orderBy('id', 'DESC')->paginate(7);

        $products = Produk::orderBy('created_at', 'DESC')->paginate(5);
        $this->data['products'] = $products;

        $product = Produk::orderBy('created_at', 'DESC');
        $this->data['product'] = $product;

        $activeProducts = Produk::where('status', '=', '1')->get();
        
        $nonActiveProducts = Produk::where('status', '=', '0');

        $orders = Pemesanan::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard.index', compact('admins', 'categories', 'customers', 'product', 'owners', 'products', 'users', 'orders', 'activeProducts', 'nonActiveProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
