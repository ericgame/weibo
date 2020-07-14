<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    //登入: 介面
    public function create()
    {
        return view('sessions.create');
    }

    //登入: 驗證
    public function store(Request $request)
    {
        $credentials=$this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        //驗證帳號密碼 與 處理"記住我"功能
        if(Auth::attempt($credentials, $request->has('remember'))){
            if(Auth::user()->activated){
                session()->flash('success', '歡迎回來！');
                $fallback=route('users.show', Auth::user());
                return redirect()->intended($fallback);
            }else{
                Auth::logout();
                session()->flash('warning', '您的帳號未完成認證，請檢查信箱中的確認信並完成認證。');
                return redirect('/');
            }
        }else{
            session()->flash('danger', 'E-mail或密碼錯誤！');
            return redirect()->back()->withInput();
        }
    }

    //登出
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '登出成功！');
        return redirect('login');
    }
}
