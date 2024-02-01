<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            $this->renderable(function (NotFoundHttpException $e, Request $request) {
                return response()->json(['data' => false, 'error' => 'NOT FOUND', 'e' => $e->getMessage()], 404);
            });

            $this->renderable(function (HttpException $e, Request $request) {
                return response()->json(['data' => false, 'error' => 'NOT FOUND', 'e' => $e->getMessage()], 404);
            });

            $this->renderable(function (QueryException $e, Request $request) {
                return response()->json(['data' => false, 'error' => 'INTERNAL SERVER ERROR', 'e' => $e->getMessage()], 500);
            });

            $this->renderable(function (OAuthServerException $e, Request $request) {
                return response()->json(['data' => false, 'error' => 'FORBIDDEN', 'e' => $e->getMessage()], 403);
            });

            $this->renderable(function (AuthenticationException $e, Request $request) {
                return response()->json(['data' => false, 'error' => 'FORBIDDEN', 'e' => $e->getMessage()], 403);
            });

            $this->renderable(function (RouteNotFoundException $e, Request $request) {
                return response()->json(['data' => false, 'error' => 'ROUTE NOT FOUND', 'e' => $e->getMessage()], 404);
            });
        });
    }
}
