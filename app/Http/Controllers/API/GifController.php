<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\addGifToFavoritesRequest;
use App\Http\Requests\searchGifRequest;
use App\Models\FavoriteGif;
use App\Http\Resources\FavoriteGifResource;
use App\Models\History;
use App\Models\ServiceNames;
use GPH\Api\DefaultApi;
use GPH\ApiException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GifController extends Controller {

    public function search(searchGifRequest $request) {
        $requestData = $request->all();

        $query = $requestData['query'];
        $limit = isset($requestData['limit']) ? $requestData['limit'] : '25';
        $offset = isset($requestData['offset']) ? $requestData['offset'] : '0';

        $api_instance = new DefaultApi();
        $api_key = env('GIPHY_API_KEY');

        try {
            $result = json_decode($api_instance->gifsSearchGet($api_key, $query, $limit, $offset, "g", "en"));

            History::store($request,ServiceNames::SEARCH_GIFS,200, $result->data);

            return $this->sendResponse($result->data, 'Gifs Search Result');
        } catch (Exception $e) {
            History::store($request,ServiceNames::SEARCH_GIFS,404, $e->getMessage());

            return $this->sendError($e->getMessage(), 'Error Giphy API');
        }
    }

    public function searchById($id, Request $request) {
        $request->merge(['id' => $id]);
        $this->validate($request,
            ['id' => 'required'],
            ['id' => 'Required Id.']
        );

        $gif_id = $id;

        $api_instance = new DefaultApi();
        $api_key = env('GIPHY_API_KEY');

        try {
            $result = json_decode($api_instance->gifsGifIdGet($api_key, $gif_id));

            History::store($request,ServiceNames::GET_BY_ID,200, $result->data);

            return $this->sendResponse($result->data, 'Gif Result');
        } catch (ApiException $e) {
            History::store($request,ServiceNames::ADD_TO_FAVORITES,404, $e->getMessage());

            return $this->sendError($e->getMessage(), 'Error Giphy API', 404);
        }
    }

    public function addGifToFavorites(addGifToFavoritesRequest $request) {
        $requestData = $request->all();

        $gif_id = $requestData['gif_id'];
        $alias = $requestData['alias'];
        $user_id = $requestData['user_id']; //$user_id = Auth::user()->id;

        $user = Auth::user();
        try {
            DB::beginTransaction();

                $newFavoriteGif = new FavoriteGif();
                $newFavoriteGif->gif_id = $gif_id;
                $newFavoriteGif->alias = $alias;
                $newFavoriteGif->user_id = $user_id;
                $newFavoriteGif->save();

                History::store($request,ServiceNames::ADD_TO_FAVORITES,200, new FavoriteGifResource($newFavoriteGif));

            DB::commit();

            return $this->sendResponse(new FavoriteGifResource($newFavoriteGif), 'Gif Saved to Favorite');
        } catch (Exception $e) {
            DB::rollBack();
            History::store($request,ServiceNames::ADD_TO_FAVORITES,400, $e->getMessage());

            return $this->sendError($e->getMessage(), 'Gif Not Saved in Favorite', 400);
        }
    }

}
