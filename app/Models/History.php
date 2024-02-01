<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'service',
        'request_body',
        'response_http_code',
        'response_body',
        'ip',
    ];

    public static function store($request, $service, $response_code, $response_body) {
        $user = Auth::user();

        $newHistory = new History();
        $newHistory->user_id = $user->id;
        $newHistory->service = ServiceNames::$names[$service];
        $newHistory->request_body = $request->getContent();
        $newHistory->response_http_code = $response_code;
        $newHistory->response_body =  substr(json_encode($response_body), 0,1000);
        $newHistory->ip =  $request->ip();
        $newHistory->save();
    }

}
