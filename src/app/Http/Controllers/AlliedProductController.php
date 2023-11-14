<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AlliedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $URL = env('API_URL', null);
        if ($URL === null) {
            abort(500, 'API_URL environment variable not set!');
        }
        $response = Http::get($URL);
        $products = $response->json();
        $viewData = [
            'products' => $products,
        ];

        return view('allied.index')->with('viewData', $viewData);
    }
}
