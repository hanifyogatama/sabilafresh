<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\AttributeRequest;
use App\Http\Requests\AttributeOptionRequest;

use App\Models\Atribut;
use App\Models\AtributOpsi;

use Session;
use App\Authorizable;

class AttributeController extends Controller
{
    use Authorizable;
    public function __construct()
    {
        $this->data['types'] = Atribut::types();
        $this->data['booleanOptions'] = Atribut::booleanOptions();
        $this->data['validations'] = Atribut::validations();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['attributes'] = Atribut::orderBy('id', 'desc')->paginate(10);

        return view('admin.attributes.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['attribute'] = null;
        return view('admin.attributes.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $params = $request->except('_token');
        $params['is_required'] = (bool) $params['is_required'];
        $params['is_unique'] = (bool) $params['is_unique'];
        $params['is_configurable'] = (bool) $params['is_configurable'];
        $params['is_filterable'] = (bool) $params['is_filterable'];

        Atribut::create($params);


        return redirect('admin/attributes')->with('success-add', 'Sukses');
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
        $attribute = Atribut::findOrFail($id);
        $this->data['attribute'] = $attribute;

        return view('admin.attributes.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['is_required'] = (bool) $params['is_required'];
        $params['is_unique'] = (bool) $params['is_unique'];
        $params['is_configurable'] = (bool) $params['is_configurable'];
        $params['is_filterable'] = (bool) $params['is_filterable'];

        unset($params['kode']);
        unset($params['tipe']);

        $attribute = Atribut::findOrFail($id);
        $attribute->update($params);

        return redirect('admin/attributes')->with('success-edit', 'Sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = Atribut::findOrFail($id);
        $attribute->delete();
        return redirect('admin/attributes')->with('success-delete', 'Sukses');
    }

    public function options($attributeID)
    {
        if (empty($attributeID)) {
            return redirect('admin/attributes');
        }

        $attribute = Atribut::findOrFail($attributeID);

        $this->data['attribute'] = $attribute;

        return view('admin.attributes.options', $this->data);
    }

    public function store_option(AttributeOptionRequest $request, $attributeID)
    {
        if (empty($attributeID)) {
            return redirect('admin/attributes');
        }

        $params = [
            'atribut_id' => $attributeID,
            'nama' => $request->get('nama'),
        ];

        AtributOpsi::create($params);

        return redirect('admin/attributes/' . $attributeID . '/options')->with('success-add', 'Sukses');
    }

    public function edit_option($optionID)
    {
        $option = AtributOpsi::findOrFail($optionID);

        $this->data['attributeOption'] = $option;
        $this->data['attribute'] = $option->atribut;

        return view('admin.attributes.options', $this->data);
    }

    public function update_option(AttributeOptionRequest $request, $optionID)
    {
        $option = AtributOpsi::findOrFail($optionID);
        $params = $request->except('_token');

        $option->update($params);

        return redirect('admin/attributes/' . $option->atribut->id . '/options')->with('success-edit', 'Sukses');;
    }

    public function remove_option($optionID)
    {
        if (empty($optionID)) {
            return redirect('admin/attributes');
        }

        $option = AtributOpsi::findOrFail($optionID);

        $option->delete();
        return redirect('admin/attributes/' . $option->atribut->id . '/options')->with('success-delete', 'Sukses');;
    }
}
