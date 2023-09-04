<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('home.name').' index';

        return view('user.home.index')->with('viewData', $viewData);
    }
}
