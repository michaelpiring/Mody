<?php

namespace App\Http\Requests\Lpd;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLpdRequest extends FormRequest
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
            'nama_lpd' => 'required|unique:tb_lpd|min:5|max:45', 
            'alamat_lpd' => 'required|min:5|max:100',
            'no_telepon_lpd' => 'required|numeric',
            'id_admin' => 'required|numeric',
            'password_admin' => 'required'
        ];
    }
}
