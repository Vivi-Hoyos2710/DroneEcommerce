<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
class AdminPageController extends Controller
{
 public function index():View
 {
    $viewData = [];
    $viewData["title"] =__('adminpanel.title');
    $viewData["message"] =__('adminpanel.welcome');
    return view('admin.index')->with("viewData", $viewData);
    }
}
?>
   