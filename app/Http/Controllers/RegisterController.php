<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index()
    {
        // 这里渲染一个视图，对应的就是 register.blade.php
        if (Auth::user()) {
            return to_route('transactions.index');
        }

        return view('register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:16|alpha_num',
        ], [
            'name.required' => '请输入姓名',
            'email.required' => '请输入邮箱',
            'email.email' => '请输入正确的邮箱格式',
            'email.unique' => '邮箱已被注册',
            'password.required' => '请输入密码',
            'password.min' => '密码长度不能小于6位',
            'password.max' => '密码长度不能大于16位',
            'password.alpha_num' => '密码只能由字母和数字组成',
        ]);
        // 使用事务确保用户和账户同时创建成功或失败
        try {
            DB::transaction(function () use ($request) {
                // 创建用户
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);

                // 创建默认现金账户
                Account::create([
                    'user_id' => $user->id,
                    'name' => '现金',
                    'type' => 'cash',
                    'balance' => 0,
                ]);
            });
            return redirect('/login')->with('success', '注册成功，请登录');
        } catch (\Exception $e) {
            // 如果失败，则还跳转到注册页面
            // withErrors 返回的时候保留错误信息，错误信息显示在密码框下面
            // withInput 会将表单数据重新填充到表单中
            return redirect('/register')->withErrors([
                'password' => '注册失败：系统错误',
            ])->withInput($request->all());
        }
    }
}
