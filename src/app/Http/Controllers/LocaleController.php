<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{

    public function setLocale(string $locale): RedirectResponse
    {
        
        if (in_array($locale, ['en', 'es'])) {
            App::setLocale($locale);
            Session::put("locale",$locale);
        }
        return redirect()->back();
    }
}