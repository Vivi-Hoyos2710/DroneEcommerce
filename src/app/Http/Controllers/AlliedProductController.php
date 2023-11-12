<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AlliedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View 
    {
        $URL = env('API_URL', 'https://jsonplaceholder.typicode.com/todos/1');
        $response = Http::get($URL);
        $products = $response->json();
        $viewData = [
            'products' => $products
        ];

        return view('allied.index')->with('viewData', $viewData);
    }
}
