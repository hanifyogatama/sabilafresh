<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $parentId = (int) $this->get('parent_id');
        $id = (int) $this->get('id');

        if ($this->method() == 'PUT') {
            if ($parentId > 0) {
                $nama = 'required:kategori,nama,' . $id . ',id,parent_id' . $parentId;
            } else {
                $nama = 'required:kategori,nama,' . $id;
            }

            $slug = 'unique:kategori,slug,' . $id;
        } else {
            $nama = 'required|unique:kategori,nama,NULL,id,parent_id,' . $parentId;
            $slug = 'unique:kategori,slug';
        }

        return [
            // medefinisikan validasi
            'nama' => $nama,
            'slug' => $slug,
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'nama kategori harus diisi'
        ];
    }
}
