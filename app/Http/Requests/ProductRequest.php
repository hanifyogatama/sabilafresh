<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            $sku = 'required|unique:produk,sku,' . $this->get('id');
            $nama = 'required|unique:produk,nama,' . $this->get('id');
        } else {
            $sku = 'required|unique:produk,sku';
            $nama = 'required|unique:produk,nama';
        }

        return [
            'sku' => $sku,
            'nama' => $nama,
            'berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'status' => 'required',
        ];
    }
}
