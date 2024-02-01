<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteGifResource extends JsonResource {

    public function toArray(Request $request): array {

        return [
            'id' => (integer)$this->id,
            'alias' => $this->alias,
            'gif_id' => $this->gif_id,
        ];
    }
}
