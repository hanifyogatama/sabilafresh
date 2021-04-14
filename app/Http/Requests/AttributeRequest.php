<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
            $kode = 'required|unique:atribut,kode,' . $this->get('id');
            $nama = 'required|unique:atribut,nama,' . $this->get('id');
        } else {
            $kode = 'required|unique:atribut,kode';
            $nama = 'required|unique:atribut,nama';
        }

        return [
            'kode' => $kode,
            'nama' => $nama,
            'tipe' => 'required',
        ];
    }
}
