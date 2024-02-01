<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteGifResource;
use App\Models\FavoriteGif;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteGifController extends Controller {

    public function index(): JsonResponse {
        $user = Auth::user();

        $favoriteGifs = FavoriteGif::getByUser($user);

        return $this->sendResponse(FavoriteGifResource::collection($favoriteGifs), 'List Favorite Gif');
    }
}
