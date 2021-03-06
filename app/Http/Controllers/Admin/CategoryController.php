<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Str;
use Session;

use App\Authorizable;


class CategoryController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Kategori::orderBy('id', 'DESC');

        $searchInput = $request->input('searchInput');
        if ($searchInput) {
            $categories = $categories->Where('nama', 'like', '%' . $searchInput . '%');
        }

        $this->data['categories'] = $categories->paginate(10);

        return view('admin.categories.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Kategori::orderBy('nama', 'ASC')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['category'] = null;

        return view('admin.categories.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['nama']);
        $params['parent_id'] = (int)$params['parent_id'];

        Kategori::create($params);

        return redirect('admin/categories')->with('success-add', 'Sukses');
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
        $category = Kategori::findOrFail($id);
        $categories = Kategori::where('id', '!=', $id)->orderBy('nama', 'asc')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['category'] = $category;
        return view('admin.categories.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['nama']);
        $params['parent_id'] = (int)$params['parent_id'];

        $category = Kategori::findOrFail($id);
        $category->update($params);

        return redirect('admin/categories')->with('success-edit', 'Sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Kategori::findOrFail($id);
        $category->delete();

        return redirect('admin/categories')->with('success-delete', 'Sukses');
    }
}
