<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

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
    public function index()
    {
        $this->data['categories'] = Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('nama', 'ASC')->get();

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

        //    $params['parent_id'] = (int)$params['parent_id'];


        if (isset($params['parent_id'])) {
            $params['parent_id'] = (int)$params['parent_id'];
        }


        // Category::create([
        //     'body' => request('body'),
        //     'title' => request('title'),
        //     'user_id' => auth()->id()
        // ]);

        if (Category::insert($params)) {
            Session::flash('success', 'Data berhasil ditambah');
        }

        return redirect('admin/categories');
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
        $category = Category::findOrFail($id);
        $categories = Category::where('id','!=',$id)->orderBy('nama', 'asc')->get();

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

        $category = Category::findOrFail($id);
        if ($category->update($params)) {
            Session::flash('success', 'data berhasil diubah');
        }

        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->delete()) {
            Session::flash('success', 'Data berhasil dihapus');
        }

        return redirect('admin/categories');
    }
}
