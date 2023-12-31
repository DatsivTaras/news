<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
               'name' => 'required',
               'surname' => 'required',
               'role' => 'required',
               'image' => '',
               'instagram' => '',
               'facebook' => '',
               'twitter' => '',
               'youTube' => '',
               'tikTok' => '',
               'patronymic' => 'required',
               'biography' => 'required',
               'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
               'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
