<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordFormRequest;


class ChangePasswordController extends Controller
{
    public function changePassword() {
        return view('auth.changepassword');
    }


    public function postchangePassword(PasswordFormRequest $request) {
        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Mật khẩu cũ không chính xác");
        }

        if(strcmp($request->get('password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Mật khẩu mới không được giống với mật khẩu cũ");
        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success", "Đổi mật khẩu thành công!");
    }
}
