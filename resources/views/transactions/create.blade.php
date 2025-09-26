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
            <form method="POST" action="{{ route('transactions.store') }}">
                @csrf
                <div class="mb-6">
                    <label for="note" class="block mb-2 text-sm font-medium text-gray-700">
                        备注 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="note" name="note" value="{{ old('note') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('note') border-red-500 @enderror"
                           placeholder="请输入备注">
                    @error('note')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-700">
                        金额 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="amount" name="amount" value="{{ old('amount') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('amount') border-red-500 @enderror"
                           placeholder="请输入金额">
                    @error('amount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-700">
                        分类
                    </label>
                    <select id="category_id" name="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                        <option value="">选择分类（可选）</option>
                        @forelse($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @empty
                            <option value="" disabled>暂无分类，请先创建分类</option>
                        @endforelse
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="account_id" class="block mb-2 text-sm font-medium text-gray-700">
                        账户
                    </label>
                    <select id="account_id" name="account_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('account_id') border-red-500 @enderror">
                        <option value="">选择账户（可选）</option>
                        @forelse($accounts as $account)
                            <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                                {{ $account->name }}
                            </option>
                        @empty
                            <option value="" disabled>暂无账户，请先创建账户</option>
                        @endforelse
                    </select>
                    @error('account_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-700">
                        类型
                    </label>
                    <select id="type" name="type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type') border-red-500 @enderror">
                        @php
                        $types = ['expense' => '支出','income' => '收入','transfer' => '转账'];
                        @endphp
                        @foreach($types as $type => $typeName)
                            <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>
                                {{ $typeName }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="time" class="block mb-2 text-sm font-medium text-gray-700">
                        时间 <span class="text-red-500">*</span>
                    </label>
                    @php
                    $time = date('Y-m-d h:m:s');
                    @endphp
                    <input type="date" value="{{ $time }}" id="time" name="time" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('time') border-red-500 @enderror">
                    
                    @error('time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-between items-center">
                    <button type="submit" class="px-6 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        保存
                    </button>
                    <a href="{{ route('transactions.index') }}" class="text-gray-600 hover:text-gray-800">
                        取消
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('scriptsAfterJs')
  <script>
  </script>
@endsection