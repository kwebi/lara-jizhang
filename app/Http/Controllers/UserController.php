<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:16',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|max:16|alpha_num',
        ], [
            'name.required' => '请输入姓名',
            'name.max' => '姓名长度不能超过16位',
            'email.required' => '请输入邮箱',
            'email.email' => '请输入正确的邮箱格式',
            'email.unique' => '邮箱已被注册',
            'password.min' => '密码长度不能小于6位',
            'password.max' => '密码长度不能大于16位',
            'password.alpha_num' => '密码只能由字母和数字组成',
        ]);
        $data = $request->only(['name', 'email']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        return redirect()->route('users.index')->with('success', '用户已更新');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', '用户已删除');
    }
}
