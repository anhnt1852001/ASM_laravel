<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{
    public function changePassword() {
        return view('auth.changepassword');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function postchangePassword(Request $request) {
        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("Lỗi","Mật khẩu không khớp");
        }

        if(strcmp($request->get('password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Mật khẩu mới không được giống với mật khẩu cũ");
        }

        $validatedData = $request->validate([
            'password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("Đổi mật khẩu thành công!");
    }
}
