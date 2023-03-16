<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return response('hello response');
    }
    public function header(Request $request): Response
    {
        $body = [
            'firstname' => 'daud',
            'lastname' => 'ramadhan'
        ];
        return response(json_encode($body), 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                'Author' => 'Daud Hidayat Ramadhan',
                'App' => 'Laravel'
            ]);
    }
    public function responseView(Request $request):Response
    {
        return response()
            ->view('hello', ['name' => 'daud']);
    }
    public function responseJson(Request $request):JsonResponse
    {
        $body = [
            'firstname' => 'daud',
            'lastname' => 'ramadhan'
        ];
        return \response()
            ->json($body);
    }
    public function responseFile(Request $request):BinaryFileResponse
    {
        return response()
            ->file(storage_path('app/public/picture/LogoDHR.png'));
    }
    public function responseDownloadFile(Request $request):BinaryFileResponse
    {
        return response()
            ->download(storage_path('app/public/picture/LogoDHR.png'));
    }
}
