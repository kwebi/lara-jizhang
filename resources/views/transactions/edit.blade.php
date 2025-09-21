<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑账单 - 记账系统</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- 样式 -->
    <script src="{{asset('cdn/tailwindcss3.4.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('cdn/daisyui-full.min.css') }}">
    
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">编辑账单</h1>
                <a href="{{ route('transactions.index') }}" class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-arrow-left mr-2"></i>返回列表
                </a>
            </div>

            <div class="p-6 bg-white rounded-lg shadow-md">
                <!-- 成功消息提示 -->
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
                @endif

                <!-- 错误消息提示 -->
                @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('transactions.update', $transaction) }}">
                    @csrf
                    @method('PUT') <!-- 关键修复：添加PUT方法 -->

                    <div class="mb-6">
                        <label for="note" class="block mb-2 text-sm font-medium text-gray-700">
                            备注 <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="note" name="note" value="{{ $transaction->note }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('note') border-red-500 @enderror"
                               placeholder="请输入备注" required>
                        @error('note')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-700">
                            金额 <span class="text-red-500">*</span>
                        </label>
                        <input type="number" step="0.01" id="amount" name="amount" value="{{ $transaction->amount }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('amount') border-red-500 @enderror"
                               placeholder="请输入金额" required>
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
                                <option value="{{ $category->id }}" {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}>
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
                                <option value="{{ $account->id }}" {{ old('account_id', $transaction->account_id) == $account->id ? 'selected' : '' }}>
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
                                $types = ['income' => '收入', 'expense' => '支出', 'transfer' => '转账'];
                            @endphp
                            @foreach($types as $type => $typeName)
                                <option value="{{ $type }}" {{ old('type', $transaction->type) == $type ? 'selected' : '' }}>
                                    {{ $typeName }}
                                </option>
                            @endforeach
                        </select>
                        @error('type') <!-- 修复：错误提示字段从category_id改为type -->
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="time" class="block mb-2 text-sm font-medium text-gray-700">
                            时间 <span class="text-red-500">*</span>
                        </label>
                        @php
                            $timeValue = old('time', $transaction->time ? $transaction->time->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i'));
                        @endphp
                        <input type="datetime-local" id="time" name="time" value="{{ $timeValue }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('time') border-red-500 @enderror" required>
                        
                        @error('time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <button type="submit" class="px-6 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-save mr-2"></i>保存更改
                        </button>
                        <a href="{{ route('transactions.index') }}" class="text-gray-600 hover:text-gray-800">
                            取消
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // 简单的表单验证
        document.querySelector('form').addEventListener('submit', function(e) {
            let note = document.getElementById('note').value.trim();
            let amount = document.getElementById('amount').value.trim();
            let time = document.getElementById('time').value.trim();
            
            if (!note) {
                e.preventDefault();
                alert('请输入备注');
                return;
            }
            
            if (!amount || isNaN(amount) || parseFloat(amount) <= 0) {
                e.preventDefault();
                alert('请输入有效的金额');
                return;
            }
            
            if (!time) {
                e.preventDefault();
                alert('请选择时间');
                return;
            }
        });
    </script>
</body>
</html>