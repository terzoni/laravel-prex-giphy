<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class searchGifRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'query' => ['required', 'max:50'],
            'limit' => ['numeric', 'max:50'],
            'offset' => ['numeric', 'min:0'],
        ];
    }
}
