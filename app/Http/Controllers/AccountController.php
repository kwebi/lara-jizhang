<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Auth\Events\Validated;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $accounts = Account::where('user_id', $request->user()->id)->get();
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(AccountRequest $request)
    {
        $data = $request->validated();

        $account = new Account();
        $account->user_id = $request->user()->id;
        $account->name = $data['name'];
        $account->type = $data['type'];
        $account->balance = $data['balance'];
        $account->save();
        return redirect()->route('accounts.index')->with('success', '账户创建成功');
    }

    public function edit(Account $account){
        return view('accounts.edit', compact('account'));
    }

    public function update(AccountRequest $request, Account $account)
    {
        $data = $request->validated();
        $account->update($data);
        return redirect()->route('accounts.index')->with('success', '账户已更新');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('accounts.index')->with('success', '账户已删除');
    }
}
