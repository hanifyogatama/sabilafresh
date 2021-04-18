<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeOptionRequest extends FormRequest
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
        $attributeID = (int) $this->get('atribut_id');
        $id = (int) $this->get('id');

        if ($this->method() == 'PUT') {
            $nama = 'required|unique:atribut_opsi,nama,' . $id . ',id,atribut_id,' . $attributeID;
        } else {
            $nama = 'required|unique:atribut_opsi,nama,NULL,id,atribut_id,' . $attributeID;
        }

        return [
            'nama' => $nama,
        ];
    }
}
