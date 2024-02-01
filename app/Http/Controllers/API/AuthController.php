<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\ServiceNames;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\loginUserRequest;

class AuthController extends Controller {

    public function login(loginUserRequest $request): JsonResponse {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();

            $success['token'] = $user->createToken('MyToken ')->accessToken;
            $success['name'] = $user->name;

            History::store($request,ServiceNames::LOGIN,200, $success);

            return $this->sendResponse($success, 'User login successfully');
        }else{
            History::store($request,ServiceNames::LOGIN,401, 'Unauthorised.');

            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised'], 401);
        }
    }
}
