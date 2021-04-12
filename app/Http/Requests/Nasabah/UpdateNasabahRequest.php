<?php

namespace App\Http\Requests\Nasabah;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNasabahRequest extends FormRequest
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
        return [
            'nama_nasabah' => 'required',
            'tgl_lahir_nasabah' => 'required|date',
            'alamat_nasabah' => 'required|min:10',
            'no_telepon_nasabah' => 'required|numeric',
            'password_nasabah' => 'required'
        ];
    }
}
