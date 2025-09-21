<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Account;
use App\Models\Member;
use App\Models\Tag;
use Illuminate\Container\Attributes\Auth;
use Intertia\Inertia;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // 列出所有交易记录
    public function index(Request $request)
    {
        $transactions = Transaction::with(['category', 'account', 'member', 'tag'])
            ->where('user_id', $request->user()->id)->paginate(15)->withQueryString();
        // dump("transactions.index");
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::all();
        $accounts = Account::all();
        $members = Member::all();
        $tags = Tag::all(); 
        return view('transactions.create',compact('categories','accounts','members','tags'));
    }
    public function store(TransactionRequest $request)
    {
                
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        Transaction::create($data);
        return redirect()->route('transactions.index')->with('success', '交易记录创建成功');
    }
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $categories = Category::all();
        $accounts = Account::all();
        $members = Member::all();
        $tags = Tag::all(); 
        // dd($transaction);
        return view('transactions.edit', compact('transaction','categories','accounts','members','tags'));
    }
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $data = $request->validated();
        // dd($data);
        $transaction->update($data);

        return redirect()->route('transactions.index')->with('success', '交易记录更新成功');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', '交易记录删除成功');
    }
}

