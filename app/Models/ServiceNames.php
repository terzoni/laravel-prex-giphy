<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class ServiceNames extends Model{

    const SEARCH_GIFS           = 1;
    const GET_BY_ID             = 2;
    const LOGIN                 = 3;
    const ADD_TO_FAVORITES      = 4;

    public static $names = [
        self::SEARCH_GIFS       => 'search-gifs',
        self::GET_BY_ID         => 'get-by-id',
        self::LOGIN             => 'login',
        self::ADD_TO_FAVORITES  => 'add-to-favorites',
    ];
}
