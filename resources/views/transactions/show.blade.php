@extends('layouts.app')
@section('title', '账单列表')

@section('content')
<div class="container px-4 py-8 mx-auto">
    <div class="mx-auto max-w-4xl">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">记账</h1>
            <a href="{{ route('transactions.index') }}" class="text-blue-600 hover:text-blue-800">
                ← 返回列表
            </a>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-md">
            <table class="table w-full">
    <!-- head -->
    <thead>
      <tr>
        <th>
          <label>
            <input type="checkbox" class="checkbox" />
          </label>
        </th>
        <th>Name</th>
        <th>Job</th>
        <th>Favorite Color</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
        
        <!-- row 1 -->
      <tr>
        <th>
          <label>
            <input type="checkbox" class="checkbox" />
          </label>
        </th>
        <td>
          <div class="flex items-center space-x-3">
            <div class="avatar">
              <div class="mask mask-squircle w-12 h-12">
                <img src="/tailwind-css-component-profile-2@56w.png" alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
            <div>
              <div class="font-bold">{{ $transaction->amount }}</div>
            </div>
          </div>
        </td>
        <td>
          {{ $transaction->category->name ?? 'No Category' }}
          <br/>
          <span class="badge badge-ghost badge-sm">  {{ $transaction->tag->name ?? 'No Tag' }}</span>
        </td>
        <td>{{ $transaction->note ?? '无备注' }}</td>
        <td>{{ $transaction->account->name ?? 'No Account' }}</td>
        <td>{{ $transaction->member->name ?? 'No Member' }}</td>
        <th>
          <button class="btn btn-ghost btn-xs"> {{ $transaction->time }} </button>
        </th>
        <th>
          <button class="btn btn-ghost btn-xs"> <a href="{{ route('transactions.edit',$transaction) }}" class="">
            编辑
        </a> </button>
        </th>
      </tr>    
        
    </tbody>
    <!-- foot -->
    <tfoot>
      <tr>
        <th></th>
        <th>Name</th>
        <th>Job</th>
        <th>Favorite Color</th>
        <th></th>
      </tr>
    </tfoot>
    
  </table>
        </div>
    </div>
</div>
@endsection


@section('scriptsAfterJs')
  <script>
  </script>
@endsection