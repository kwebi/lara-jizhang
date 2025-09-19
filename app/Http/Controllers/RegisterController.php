<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        // 后续业务逻辑
        // 添加数据我们使用用户模型，首先 new User()
        // 得到 $userModel
        $userModel = new User();
        // 填充 name 字段
        $userModel->name = $request->get('name');
        // 填充 email 字段
        $userModel->email = $request->get('email');
        // 填充 password 字段
        // Laravel 框架自带了密码加密功能，使用 bcrpt 方法加密密码
        $userModel->password = bcrypt($request->get('password'));
        // 调用 save 方法保存数据。如果保存成功，则跳转到 login 登录页面，目前还没有
        if ($userModel->save()) {
            return redirect('/login');
        }

        // 如果失败，则还跳转到注册页面
        // withErrors 返回的时候保留错误信息，错误信息显示在密码框下面
        // withInput 会将表单数据重新填充到表单中
        return redirect('/register')->withErrors([
            'password' => '注册失败',
        ])->withInput($request->all());
    }
}
