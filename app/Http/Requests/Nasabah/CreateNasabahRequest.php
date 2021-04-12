<?php

namespace App\Http\Requests\Nasabah;

use Illuminate\Foundation\Http\FormRequest;

class CreateNasabahRequest extends FormRequest
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
            'nik_nasabah' => 'required|unique:tb_nasabah',
            'tgl_lahir_nasabah' => 'required|date',
            'alamat_nasabah' => 'required|min:10',
            'no_telepon_nasabah' => 'required|numeric',
            'email_nasabah' => 'required|unique:tb_nasabah',
            'username_nasabah' => 'required|unique:tb_nasabah',
            'password_nasabah' => 'required'
        ];
    }
}
