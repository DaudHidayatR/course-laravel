<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectTo(): string
    {
        return "redirect To";
    }
    public function redirectForm():RedirectResponse
    {
        return  redirect('/redirect/to');
    }
    public function redirectHello(string $name): string
    {
        return "Hello $name";
    }
    public function redirectName():RedirectResponse
    {
        return redirect() ->route('redirect-hello', ['name' => 'Daud']);
    }

    public function redirectAction():RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], ['name'=> 'Daud']);
    }
    public function redirectAway():RedirectResponse
    {
        return redirect()->away('https:/www.google.com');
    }
}
