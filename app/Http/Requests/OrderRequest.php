<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'nama_depan'    => 'required|string',
            'nama_belakang' => 'required|string',
            'alamat'        => 'required|string',
            'provinsi_id'   => 'required|numeric',
            'kota_id'       => 'required|numeric',
            'kode_pos'      => 'required|numeric',
            'no_hp'         => 'required',
            'layanan_kurir' => 'required|string',
        ];

        $shipTo = $this->get('ship_to');

        if ($shipTo) {
            $rules = array_merge($rules, [
                'nama_depan_pengiriman'         => 'required|string',
                'nama_belakang_pengiriman'      => 'required|string',
                'alamat_pengiriman'             => 'required|string',
                'provinsi_id_pengiriman'        => 'required|numeric',
                'kota_id_pengiriman'            => 'required|numeric',
                'kode_pos_pengiriman'           => 'required|numeric',
                'no_hp_pengiriman'              => 'required',
                'email_pengiriman'              => 'email',
            ]);
        }

        return $rules;
    }
}
