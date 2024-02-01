<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addGifToFavoritesRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array
    {
        return [
            'gif_id' => 'required',
            'alias' => 'required',
            'user_id' => 'required',
        ];
    }
}
