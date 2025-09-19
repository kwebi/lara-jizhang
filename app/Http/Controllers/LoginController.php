<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // dd('User is authenticated, redirecting from login to home');
            // return redirect('transactions/index');
            // dump("to_route('transactions.index');");
            return to_route('transactions.index');
        }
        // dump('User is not authenticated, showing login page');
        return view('login');
    }

    public function store(Request $request) {
        // 添加验证逻辑
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:16|alpha_num',
        ], [
            'email.required' => '请输入邮箱',
            'email.email' => '请输入正确的邮箱格式',
            'password.required' => '请输入密码',
            'password.min' => '密码长度不能小于6位',
            'password.max' => '密码长度不能大于16位',
            'password.alpha_num' => '密码只能由字母和数字组成'
        ]);

        // 这里进行登录逻辑
        if (Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ])) {
            // 登录成功就跳转到首页
            return to_route('transactions.index');
        }

        // 如果登录失败，则返回错误信息
        // withInput 保留邮箱的输入信息
        return redirect('/login')->withErrors([
            'password' => '登录失败'
        ])->withInput($request->except('password'));
    }
    public function logout()
    {
        // 退出登录
        Auth::logout();

        // 退出登录之后跳转到某个页面
        return redirect('/login');
    }
}
