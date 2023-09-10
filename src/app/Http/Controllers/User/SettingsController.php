<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
class SettingsController extends Controller
{
    /**
     * Made by Vivi
     */
    public function index(): View
    {
        $viewData = [];
        $viewData["title"] = "Settings";
        $viewData["subtitle"] = "My Account";
        $viewData["userData"] = Auth::user();
        return view('user.settings.index')->with("viewData", $viewData);
    }
    public function update(Request $request): RedirectResponse
    {
        $updateInfo='';
        $user= Auth::user();
        if (!Hash::check($request->input('current_password'),$user->getPassword())) {
            return redirect()->route('user.account')->with('error', 'Current password is incorrect.');
        }
        if ($request->has('name')) {
            $updateInfo=User::validateEach($request,'name');
            $user->setName($request->input($updateInfo));
        }elseif ($request->has('email')) {
            $updateInfo=User::validateEach($request,'email');
            $user->setEmail($request->input($updateInfo));
        }elseif ($request->has('username')) {
            $updateInfo=User::validateEach($request,'username');
            $user->setUserName($request->input($updateInfo));
        }else{
            $updateInfo=User::validateEach($request,'password');
            $user->setPassword(Hash::make($request->input($updateInfo)));
        }
        $user->save();

        return redirect()->route('user.account')->with('success', 'changes applied in the update of '.$updateInfo);
    }

   
}
