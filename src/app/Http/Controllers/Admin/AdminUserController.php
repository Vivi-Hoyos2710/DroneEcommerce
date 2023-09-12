<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('adminpanel.users');
        $viewData['message'] = __('adminpanel.welcome');
        $viewData['table_header'] = ['id', 'name', 'email','username','balance', 'created_at', 'updated_at','delete'];
        $viewData['users'] = User::all();

        return view('admin.user.index')->with('viewData', $viewData);
    }

    public function delete(string $id): RedirectResponse
    {
        User::destroy($id);
        return redirect()->route('admin.user.index')->with('delete', 'Deleted user id: '.$id);
    }



}
