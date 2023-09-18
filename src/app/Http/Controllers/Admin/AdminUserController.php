<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $authenticatedUser = Auth::user();
        $viewData = [];
        $viewData['title'] = __('adminpanel.users');
        $viewData['message'] = __('adminpanel.welcome');
        $viewData['table_header'] = ['id', 'name', 'email','username','balance', 'created_at', 'updated_at','delete','edit'];
        $viewData['users'] = User::where('id', '!=', $authenticatedUser->getId())->get();

        return view('admin.user.index')->with('viewData', $viewData);
    }

    public function delete(string $id): RedirectResponse
    {
        User::destroy($id);
        return redirect()->route('admin.user.index')->with('delete', 'Deleted user id: '.$id);
    }
    public function edit(string $userId):View
    {
        $viewData=[];
        $viewData['title']="Update";
        $viewData['user_info']=User::findOrFail($userId);
        return view('admin.user.update')->with('viewData', $viewData);
    }

    public function update(Request $request,string $userId): RedirectResponse
    {
        $adminAuth= Auth::user();
        $user= User::findOrFail($userId);
        
        if (! Hash::check($request->input('password'), $adminAuth->getPassword())) {
            return redirect()->route('admin.user.edit',$userId)->with('error', 'Admin password is incorrect.');
        }
        User::validateAllFields($request,$userId);
        $user->setName($request->input('name'));
        $user->setRole($request->input('rol'));
        $user->setEmail($request->input('email'));
        $user->setBalance(intval($request->input('balance')));
        $user->setUserName($request->input('username'));
        $user->save();
        return redirect()->route('admin.user.edit',$userId)->with('success', 'changes applied in the update of user with id'.$userId);

    }


}
