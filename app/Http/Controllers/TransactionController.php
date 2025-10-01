<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Account;
use App\Models\Member;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
use Illuminate\Support\Facades\Log;


class TransactionController extends Controller
{
    // 列出所有交易记录
    public function index(Request $request)
    {
        // $transactions = Transaction::with(['category', 'account', 'member', 'tag'])
        //     ->where('user_id', $request->user()->id)->orderBy('time', 'desc')->paginate(15)->withQueryString();
        // dump("transactions.index");
        // $groupedTransactions = $transactions->groupBy(function ($item) {
        //     return $item->time->format('Y-m-d');
        // });
        // dump(response()->json([
        //         'code' => 0,
        //         'msg' => '',
        //         'count' => $transactions->total(),
        //         'data' => $transactions->items()
        //     ]));
        if ($request->ajax()) {
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 15);
            $transactions = Transaction::with(['category', 'account', 'member', 'user'])
                ->where('user_id', $request->user()->id)
                ->orderBy('time', 'desc')
                ->paginate($limit, ['*'], 'page', $page);

            return response()->json([
                'code' => 0,
                'msg' => '',
                'count' => $transactions->total(),
                'data' => TransactionResource::collection($transactions->items())
            ]);
        }
        return view('transactions.index');
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

    public function destroy(Request $request, $id)
    {
        try {
            // 查找记录
            $transaction = Transaction::find($id);
            // 检查记录是否存在
            if (!$transaction) {
                return response()->json([
                    'code' => 404,
                    'msg' => '记录不存在'
                ], 404);
            }
            // 检查权限（确保用户只能删除自己的记录）
            if ($transaction->user_id != $request->user()->id) {
                return response()->json([
                    'code' => 403,
                    'msg' => '无权操作此记录'
                ], 403);
            }

            // 执行删除
            $transaction->delete();

            // 返回成功响应
            return response()->json([
                'code' => 0,
                'msg' => '删除成功'
            ]);
        } catch (\Exception $e) {
            // 记录错误日志
            Log::error('删除交易记录失败: ' . $e->getMessage());

            return response()->json([
                'code' => 500,
                'msg' => '删除失败，请稍后重试'
            ], 500);
        }
        // $transaction->delete();
        
        // return redirect()->route('transactions.index')->with('success', '交易记录删除成功');
    }
}

