<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class  AuthorsEditRequest extends FormRequest
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
        $request = request()->all();

        return [
            'name' => 'required',
            'surname' => 'required',
            'email' => ['required', 'email', \Illuminate\Validation\Rule::unique('users')->ignore($request['id'])],
            'image' => '',
            'patronymic' => 'required',
            'biography' => 'required',
        ];
    }
}
