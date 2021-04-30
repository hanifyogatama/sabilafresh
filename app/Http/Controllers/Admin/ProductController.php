<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\GambarProduk;
use App\Models\Atribut;
use App\Models\AtributOpsi;
use App\Models\InventoriProduk;
use App\Models\AtributProduk;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductImageRequest;

use Str;
use Auth;
use DB;
use Session;
use App\Authorizable;

class ProductController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        $this->data['statuses'] = Produk::statuses();
        $this->data['types'] = Produk::types();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Produk::orderBy('id', 'DESC');

        $searchInput = $request->input('searchInput');
        if ($searchInput) {
            $products = $products->Where('sku', 'like', '%' . $searchInput . '%')
                ->orWhere('nama', 'like', '%' . $searchInput . '%');
        }

        $this->data['products'] = $products->paginate(10);
        return view('admin.products.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Kategori::orderBy('nama', 'DESC')->get();
        $configurableAttributes = $this->getConfigurableAttributes();

        $this->data['categories'] = $categories->toArray();
        $this->data['product'] = null;
        $this->data['categoryIDs'] = [];
        $this->data['productID'] = 0;
        $this->data['configurableAttributes'] = $configurableAttributes;

        return view('admin.products.form', $this->data);
    }

    private function getConfigurableAttributes()
    {
        return Atribut::where('is_configurable', true)->get();
    }


    private function generateAttributeCombinations($arrays)
    {
        $result = [[]];
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }


    private function convertVariantAsName($variant)
    {
        $variantName = '';

        foreach (array_keys($variant) as $key => $kode) {
            $attributeOptionID = $variant[$kode];
            $attributeOption = AtributOpsi::find($attributeOptionID);

            if ($attributeOption) {
                $variantName .= ' - ' . $attributeOption->nama;
            }
        }

        return $variantName;
    }

    private function generateProductVariants($product, $params)
    {
        $configurableAttributes = $this->getConfigurableAttributes();

        $variantAttributes = [];
        foreach ($configurableAttributes as $attribute) {
            $variantAttributes[$attribute->kode] = $params[$attribute->kode];
        }

        $variants = $this->generateAttributeCombinations($variantAttributes);

        if ($variants) {
            foreach ($variants as $variant) {
                $variantParams = [
                    'parent_id' => $product->id,
                    'user_id' => Auth::user()->id,
                    'sku' => $product->sku . '-' . implode('-', array_values($variant)),
                    'tipe' => 'simple',
                    'nama' => $product->nama . $this->convertVariantAsName($variant),
                ];

                $variantParams['slug'] = Str::slug($variantParams['nama']);

                $newProductVariant = Produk::create($variantParams);

                $categoryIds = !empty($params['category_ids']) ? $params['category_ids'] : [];
                $newProductVariant->kategories()->sync($categoryIds);

                $this->saveProductAttributeValues($newProductVariant, $variant);
            }
        }
    }

    private function saveProductAttributeValues($product, $variant)
    {
        foreach (array_values($variant) as $attributeOptionID) {
            $attributeOption = AtributOpsi::find($attributeOptionID);

            $attributeValueParams = [
                'produk_id' => $product->id,
                'atribut_id' => $attributeOption->atribut_id,
                'nama' => $attributeOption->nama,
            ];

            AtributProduk::create($attributeValueParams);
        }
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

        $product = DB::transaction(function () use ($params) {
            $categoryIds = !empty($params['category_ids']) ? $params['category_ids'] : [];
            $product = Produk::create($params);
            $product->kategories()->sync($categoryIds);

            if ($params['tipe'] == 'configurable') {
                $this->generateProductVariants($product, $params);
            }

            return $product;
        });

        // if ($product) {
        //     Session::flash('success', 'Product has been saved');
        // } else {
        //     Session::flash('error', 'Product could not be saved');
        // }

        return redirect('admin/products/' . $product->id . '/edit/');
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

        $product = Produk::findOrFail($id);
        $product->qty = isset($product->inventoriProduk) ? $product->inventoriProduk->qty : null;

        $categories = Kategori::orderBy('nama', 'ASC')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['product'] = $product;
        $this->data['productID'] = $product->id;
        $this->data['categoryIDs'] = $product->kategories->pluck('id')->toArray();

        return view('admin.products.form', $this->data)->with('success-edit', 'Sukses');
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

        $product = Produk::findOrFail($id);

        $saved = false;
        $saved = DB::transaction(function () use ($product, $params) {
            $categoryIds = !empty($params['category_ids']) ? $params['category_ids'] : [];
            $product->update($params);
            $product->kategories()->sync($categoryIds);

            if ($product->tipe == 'configurable') {
                $this->updateProductVariants($params);
            } else {
                InventoriProduk::updateOrCreate(['produk_id' => $product->id], ['qty' => $params['qty']]);
            }

            return true;
        });

        // if ($saved) {
        //     Session::flash('success', 'Product has been saved');
        // } else {
        //     Session::flash('error', 'Product could not be saved');
        // }

        return redirect('admin/products')->with('success-add', 'success');
    }


    private function updateProductVariants($params)
    {
        if ($params['variants']) {
            foreach ($params['variants'] as $productParams) {
                $product = Produk::find($productParams['id']);
                $product->update($productParams);

                $product->status = $params['status'];
                $product->save();

                InventoriProduk::updateOrCreate(['produk_id' => $product->id], ['qty' => $productParams['qty']]);
            }
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
        $product  = Produk::findOrFail($id);

        $product->delete();
        return redirect('admin/products')->with('success-delete', 'Sukses');
    }


    public function images($id)
    {
        if (empty($id)) {
            return redirect('admin/products/create');
        }

        $product = Produk::findOrFail($id);

        $this->data['productID'] = $product->id;
        $this->data['productImages'] = $product->gambarProduk;

        return view('admin.products.images', $this->data);
    }


    public function add_image($id)
    {
        if (empty($id)) {
            return redirect('admin/products');
        }

        $product = Produk::findOrFail($id);

        $this->data['productID'] = $product->id;
        $this->data['product'] = $product;

        return view('admin.products.image_form', $this->data);
    }

    public function upload_image(ProductImageRequest $request, $id)
    {
        $product = Produk::findOrFail($id);

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $product->slug . '_' . time();
            $fileName = $name . '.' . $image->getClientOriginalExtension();

            $folder = GambarProduk::UPLOAD_DIR . '/images';

            $filePath = $image->storeAs($folder . '/original', $fileName, 'public');

            $resizedImage = $this->_resizeImage($image, $fileName, $folder);

            $params = array_merge(
                [
                    'produk_id' => $product->id,
                    'path' => $filePath,
                ],

                $resizedImage
            );

            if (GambarProduk::create($params)) {
                Session::flash('success', 'Gambar berhasil ditambah');
            } else {
                Session::flash('error', 'Gambar gagal ditambah');
            }

            return redirect('admin/products/' . $id . '/images');
        }
    }


    public function _resizeImage($image, $fileName, $folder)
    {
        $resizedImage = [];

        $smallImageFilePath = $folder . '/small/' . $fileName;
        $size = explode('x', GambarProduk::SMALL);
        list($width, $height) = $size;

        $smallImageFile = \Image::make($image)->fit($width, $height)->stream();
        if (\Storage::put('public/' . $smallImageFilePath, $smallImageFile)) {
            $resizedImage['gambar_kecil'] = $smallImageFilePath;
        }

        $mediumImageFilePath = $folder . '/medium/' . $fileName;
        $size = explode('x', GambarProduk::MEDIUM);
        list($width, $height) = $size;

        $mediumImageFile = \Image::make($image)->fit($width, $height)->stream();
        if (\Storage::put('public/' . $mediumImageFilePath, $mediumImageFile)) {
            $resizedImage['gambar_medium'] = $mediumImageFilePath;
        }

        $largeImageFilePath = $folder . '/large/' . $fileName;
        $size = explode('x', GambarProduk::LARGE);
        list($width, $height) = $size;

        $largeImageFile = \Image::make($image)->fit($width, $height)->stream();
        if (\Storage::put('public/' . $largeImageFilePath, $largeImageFile)) {
            $resizedImage['gambar_besar'] = $largeImageFilePath;
        }

        $xlargeImageFilePath = $folder . '/xlarge/' . $fileName;
        $size = explode('x', GambarProduk::X_LARGE);
        list($width, $height) = $size;

        $xlargeImageFile = \Image::make($image)->fit($width, $height)->stream();
        if (\Storage::put('public/' . $xlargeImageFilePath, $xlargeImageFile)) {
            $resizedImage['gambar_xbesar'] = $xlargeImageFilePath;
        }

        return $resizedImage;
    }

    public function remove_image($id)
    {
        $image = GambarProduk::findOrFail($id);

        Storage::disk('public')->delete($image->path);
        Storage::disk('public')->delete($image->gambar_xbesar);
        Storage::disk('public')->delete($image->gambar_besar);
        Storage::disk('public')->delete($image->gambar_medium);
        Storage::disk('public')->delete($image->gambar_kecil);

        if ($image->delete()) {
            Session::flash('success', 'Gambar berhasi dihapus');
        } else {
            Session::flash('error', 'Gambar gagal dihapus');
        }

        return redirect('admin/products/' . $image->produk->id . '/images');
    }
}
