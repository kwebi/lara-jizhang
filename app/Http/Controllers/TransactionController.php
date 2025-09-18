<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Account;
use App\Models\Member;
use App\Models\Tag;


class TransactionController extends Controller
{
    // 列出所有交易记录
    public function index(TransactionRequest $request)
    {
        $transactions = Transaction::with(['category', 'account', 'member', 'tag'])
            ->where('user_id', $request->user())->paginate(15)->withQueryString();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $catagories = Category::all();
        $accounts = Account::all();
        $members = Member::all();
        $tags = Tag::all(); 
        return view('transactions.create',compact('catagories','accounts','members','tags'));
    }
    public function store(TransactionRequest $request)
    {
        $data['user_id'] = $request->user();

        Transaction::create($data);

        return redirect()->route('transactions.index')->with('success', '交易记录创建成功');
    }
    public function edit(Transaction $transaction)
    {
        $catagories = Category::all();
        $accounts = Account::all();
        $members = Member::all();
        $tags = Tag::all(); 
        return view('transactions.edit', compact('transaction','catagories','accounts','members','tags'));
    }
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $data = $request->validated();
        $transaction->update($data);

        return redirect()->route('transactions.index')->with('success', '交易记录更新成功');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', '交易记录删除成功');
    }
}

