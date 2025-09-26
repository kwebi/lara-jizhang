@extends('layouts.app')
@section('title', '账单列表')

@section('content')

<div class="overflow-x-auto w-full">
  <table class="table">
    
    <tbody>
        @forelse  ($groupedTransactions as $createTime => $transactions)
        <tr>
            <th class="text-xs font-medium opacity-90">{{ $createTime }}</th>
        </tr>
        
        <!-- row 1 -->
        @foreach($transactions as $transaction)
      <tr>
        <th>
          <label>
            <input type="checkbox" class="checkbox" />
          </label>
        </th>
        <td>
          <div class="flex items-center gap-3">
            <div class="avatar">
              <div class="mask mask-squircle h-12 w-12">
                <img
                  src="https://img.daisyui.com/images/profile/demo/2@94.webp"
                  alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
            <div>
              <div class="font-medium text-lg">{{ $transaction->category->name }}</div>
              <div class="font-light text-sm">{{ $transaction->note ?? ' ' }} </div>
              <div class="text-xs opacity-50">{{ $transaction->account->name}}  {{ $transaction->tag->name ?? '  ' }}</div>
            </div>
          </div>
        </td>
        <td>{{ $transaction->amount }}</td>
      </tr>
      @endforeach
      
      @empty
      
      @endforelse
    </tbody>
    
  </table>
</div>

  <div class="btn-group">
    <button class="btn">流水</button>
    <button class="btn">报表</button>
    <a href="{{route('transactions.create')}}">
      <button class="btn" >记一笔 </button>
    </a>
    <button class="btn">成员</button>
    <button class="btn">设置</button>
  </div>
@endsection


@section('scriptsAfterJs')
  <script>
  </script>
@endsection