<x-layout>
  <x-slot:header>用户注册</x-slot:header>
<div class="container px-4 py-8 mx-auto">
    <div class="mx-auto max-w-4xl">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">写文章</h1>
            <a href="{{ route('transactions.index') }}" class="text-blue-600 hover:text-blue-800">
                ← 返回列表
            </a>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-md">
            <form method="POST" action="{{ route('transactions.store') }}">
                @csrf

                <div class="mb-6">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-700">
                        文章标题 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                           placeholder="请输入文章标题">
                    @error('title')
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
                    <label for="content" class="block mb-2 text-sm font-medium text-gray-700">
                        文章内容 <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content" name="content" rows="12"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror"
                              placeholder="请输入文章内容...">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-700">
                        发布状态 <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>保存为草稿</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>立即发布</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center">
                    <button type="submit" class="px-6 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        保存文章
                    </button>
                    <a href="{{ route('transactions.index') }}" class="text-gray-600 hover:text-gray-800">
                        取消
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</x-layout>