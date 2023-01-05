<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Response::macro('success', function ($data = [], $message = 'Success', $code = 200) {
            return Response::json([
                'status' => 'success',
                'message' => $message,
                'data' => $data
            ], $code)->getContent();
        });

        Response::macro('error', function ($data = [], $message = 'Error', $code = 400) {
            return Response::json([
                'status' => 'error',
                'message' => $message,
                'data' => null
            ], $code)->getContent();
        });
    }
}
