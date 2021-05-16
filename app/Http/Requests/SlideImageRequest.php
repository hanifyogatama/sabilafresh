<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideImageRequest extends FormRequest
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

        $rules = [
            'status' => 'required',
        ];

        if ($this->method() == 'POST') {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:4092';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'image.required'         => 'gambar belum diisi',
            'image.image'           => 'cek kembali format file',
            'status.required'       => 'status belum dipilih',
        ];
    }
}
