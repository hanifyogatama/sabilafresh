<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductImageRequest;

use Str;
use Auth;
use DB;
use Session;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->data['statuses'] = Product::statuses();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['products'] = Product::orderBy('nama', 'DESC')->paginate(10);

        return view('admin.products.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('nama', 'DESC')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['products'] = null;
        $this->data['productID'] = 0;
        $this->data['categoryIDs'] = [];

        return view('admin.products.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['nama']);
        $params['user_id'] = Auth::user()->id;

        $saved = false;
        $saved = DB::transaction(function () use ($params) {
            $product = Product::create($params);
            $product->categories()->sync($params['category_ids']);

            return true;
        });

        if ($saved) {
            Session::flash('success', 'Data berhasil ditambah');
        } else {
            Session::flash('error', 'Data gagal ditambah');
        }

        return redirect('admin/products');
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
        if (empty($id)) {
            return redirect('admin/products/create');
        }

        $product = Product::findOrFail($id);
        $categories = Category::orderBy('nama', 'ASC')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['product'] = $product;
        $this->data['productID'] = $product->id;
        $this->data['categoryIDs'] = $product->categories->pluck('id')->toArray();

        return view('admin.products.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['nama']);

        $product = Product::findOrFail($id);

        $saved = false;
        $saved = DB::transaction(function () use ($product, $params) {
            $product->update($params);
            $product->categories()->sync($params['category_ids']);

            return true;
        });

        if ($saved) {
            Session::flash('success', 'Data berhasil ditambah');
        } else {
            Session::flash('error', 'Data gagal ditambah');
        }

        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product  = Product::findOrFail($id);

        if ($product->delete()) {
            Session::flash('success',  'Data berhasil ditambah');
        }

        return redirect('admin/products');
    }

    public function images($id)
    {
        if (empty($id)) {
            return redirect('admin/products/create');
        }

        $product = Product::findOrFail($id);

        $this->data['productID'] = $product->id;
        $this->data['productImages'] = $product->productImages;

        return view('admin.products.images', $this->data);
    }

    public function add_image($id)
    {
        if (empty($id)) {
            return redirect('admin/products');
        }

        $product = Product::findOrFail($id);

        $this->data['productID'] = $product->id;
        $this->data['product'] = $product;

        return view('admin.products.image_form', $this->data);
    }

    public function upload_image(ProductImageRequest $request, $id)
    {
        $product = product::findOrFail($id);

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $product->slug . '_' . time();
            $fileName = $name . '_' . $image->getClientOriginalExtension();

            $folder = '/upload/images';
            $filePath = $image->storeAs($folder, $fileName, 'public');

            $params = [
                'product_id' => $product->id,
                'path' => $filePath,
            ];

            if (ProductImage::create($params)) {
                Session::flash('success', 'Gambar berhasil ditambah');
            } else {
                Session::flash('error', 'Gambar gagal ditambah');
            }

            return redirect('admin/products/' . $id . '/images');
        }
    }

    public function remove_image($id)
    {
        $image = ProductImage::findOrFail($id);

        if ($image->delete()) {
            Session::flash('success', 'Gambar berhasi dihapus');
        } else {
            Session::flash('error', 'Gambar gagal dihapus');
        }

        return redirect('admin/products/' . $image->product->id . '/images');
    }
}
