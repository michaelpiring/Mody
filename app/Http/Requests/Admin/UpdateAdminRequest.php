<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            'nama_admin' => 'required|min:5|max:45',
            'nik_admin' => 'required',
            'alamat_admin' => 'required|min:5|max:199',
            'tgl_lahir_admin' => 'required|date',
            'password_admin' => 'required',
        ];
    }
}
