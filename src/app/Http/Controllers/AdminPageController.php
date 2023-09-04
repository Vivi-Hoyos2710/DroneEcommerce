<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminPageController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('adminpanel.title');
        $viewData['message'] = __('adminpanel.welcome');

        return view('admin.index')->with('viewData', $viewData);
    }
}
?>
   