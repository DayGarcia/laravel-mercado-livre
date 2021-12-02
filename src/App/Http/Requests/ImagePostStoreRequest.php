<?php

namespace App\Http\Requests\LaravelMercadoLivre;

use Illuminate\Foundation\Http\FormRequest;

class ImagePostStoreRequest extends FormRequest
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
            // validate if image is a jpg/jpee/png/ file with 10MB size
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ];
    }
}
