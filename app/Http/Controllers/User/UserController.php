<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Doctor;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\DB;

/*
 * 這是針對網頁端 Controller...
 *
 * 在這裡，我要慎重說明，
 * 此控制器只負責Web端的登入、註冊、登出功能
 * 目前已完善
 * 資料庫[tables]: users / doctors / clinic_hospitals / admins
 * 之後上傳至 Heroku 需再做功課！！！
 * */

class UserController extends Controller
{
    public function create(Request $request)
    {
        //檢查 輸入
        /*
         * 更動點:
         *     可新增輸入資料欄位
         *     隨之更動:
         *         1. *.blade.php 2. controller function validate 3. database migration 4. model 5. etc.
         * */
        $request->validate([
            //在 register.blade.php 中 <input name="..."> 對應以下輸入欄位
            //在右式，會依照下面的"條件"，來檢查是否"合格"
            'role' => 'required',
            'name' => 'required',
            'code' => 'required_if:role,doctor,exists:clinic_hospitals,clinic_id',
            //條件: unique:users,email 指 資料庫 table 'users' 之 'email' 欄位 檢查
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:30',
            'cellphone' => 'required',
            //條件: same:password 指 與 'password'之值 相同
            'cpassword' => 'required|min:5|max:30|same:password',
        ], [
            'role.required' => 'You have to choose one or all of roles',
        ]);
//        $search = DB::select('select clinic_id from clinic_hospitals where id = :id',['id'=>1]);
//        dd($search);
        // 通過上方條件，我們就可以 insert 新的資料
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        if ($request->role == 'doctor') {
            $user->is_doctor = true;
        } else {
            $user->is_doctor = false;
        }
        $user->cellphone = $request->cellphone;
        $SavetoUser = $user->save();
//
        if( $SavetoUser ){
            if($request->role == 'doctor'){
                $user_id_query = DB::select('select id from users where email = :email',['email'=>$request->email]);
                $user_id = $user_id_query[0]->id;
                $doctor = new Doctor();
                $doctor->clinic_id = $request->code;
                $doctor->user_id = $user_id;
                $SavetoDoctor = $doctor->save();
                if( $SavetoDoctor ){
                    return redirect()
                        ->back()       //閃存會話對應 session('success')
                        ->with('success','successfully');
                }else{
                    return redirect()
                        ->back()       //閃存會話對應 session('success')
                        ->with('fail','Something went wrong, fail to register');
                }
            }else{ //role == patient
                return redirect()
                    ->back()       //閃存會話對應 session('success')
                    ->with('success','successfully');
            }
        }else{
            return redirect()
                ->back()       //閃存會話對應 session('success')
                ->with('fail','Something went wrong, fail to register');
        }
    }
    public function check(Request $request){
        //檢查輸入
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|max:30',
        ], [ // 可以設定 當違反時，做出相應對策{回覆}
            'email.exists'=>'This email is not exists on user table'
        ]);
        //資料庫檢驗
        $ccreds = $request->only('email','password');
        if( Auth::guard('web')->attempt($ccreds) ){
            return redirect()->route('user.home.doctor');
        }else{
            return redirect()->route('user.login')
                ->with('fail','Incorrect credentials');
        }
    }
    public function logout() {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
