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
        $qty = 'numeric';
        $harga = 'numeric';
        $status = '';
        $berat = 'numeric';

        if ($this->method() == 'PUT') {
            $tipe = '';
            $sku = 'required|unique:produk,sku,' . $this->get('id');
            $nama = 'required|unique:produk,nama,' . $this->get('id');
            $status = 'required';

            if ($this->get('tipe') == 'simple') {
                $qty .= '|required';
                $harga .= '|required';
                $berat .= '|required';
            }
        } else {
            $tipe = 'required';
            $sku = 'required|unique:produk,sku';
            $nama = 'required|unique:produk,nama';
        }

        return [
            'tipe' => $tipe,
            'sku' => $sku,
            'nama' => $nama,
            'harga' => $harga,
            'qty' => $qty,
            'status' => $status,
            'berat' => $berat,
        ];
    }
}
