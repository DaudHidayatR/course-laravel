<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
//        '/input/hello',
//        '/input/hello/first',
//        '/input/hello/input',
//        '/input/hello/array',
//        '/input/type',
//        '/input/filter/only',
//        '/input/filter/except',
//        '/input/filter/merge',
//        '/file/upload'
    ];

}
