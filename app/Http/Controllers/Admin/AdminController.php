<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;

class AdminController extends Controller
{
    public function check(Request $request) {
        //檢查輸入
        $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:30',
        ], [ // 可以設定 當違反時，做出相應對策(回覆)
            'email.exists'=>'This email is not exists on user table'
        ]);
        //做更深入的檢驗
        $ccreds = $request->only('email','password');
        if( Auth::guard('admin')->attempt($ccreds) ){
            //Auth::guard('admin')
            //在config目錄下，auth.php 的
            //guard 數組 手動註冊了 'admin' 權限，可以去看看
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('admin.login')
                ->with('fail','Incorrect credentials');
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
