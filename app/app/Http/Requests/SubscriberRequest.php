<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class SubscriberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'phone' => 'required|min:9|max:11',
            'status' => 'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Nome é Obrigatório',
            'name.min' => 'Nome precisa ter no minimo 3 caracteres',
            'name.max' => 'Nome precisa ter no maximo 255 caracteres',
            'phone.required' => 'Telefone é Obrigatório',
            'phone.min' => 'Telefone precisa ter no minimo 9 caracteres',
            'phone.max' => 'Telefone precisa ter no maximo 11 caracteres',
            'status.required' => 'Status é obrigatório',
        ];
    }
}
