@extends('layouts.app')
@section('title', '分类列表')

@section('content')
<div class="overflow-x-auto w-full">
    <div class="p-6 bg-white rounded-lg shadow-md">
    <form method="POST" action="{{ route('categories.update', $category) }}">
      @csrf
      @method('PUT') <!-- 关键修复：添加PUT方法 -->
      <div class="mb-6">
          <label for="name" class="block mb-2 text-sm font-medium text-gray-700">
              名称 <span class="text-red-500">*</span>
          </label>
          <input type="text" id="name" name="name" value="{{$category->name ?? old('name') }}"
                 class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                 placeholder="请输入分类名称">
          @error('name')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
      </div>
      <div class="mb-6">
        <label for="parent_id" class="block mb-2 text-sm font-medium text-gray-700">
            父分类
        </label>
        <select id="parent_id" name="parent_id"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('parent_id') border-red-500 @enderror">
             
            <option value="">作为一级分类</option>
            @forelse($parents as $parent)
                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }} 
                    @if (isset($category->parent_id) && $category->parent_id && $category->parent_id == $parent->id) selected @endif >
                    {{ $parent->name }}
                </option>
            @empty
                <option value="" disabled>暂无分类，请先创建分类</option>
            @endforelse
        </select>
        @error('parent_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label for="type" class="block mb-2 text-sm font-medium text-gray-700">
            类型<span class="text-red-500">*</span>
        </label>
        <select id="type" name="type"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type') border-red-500 @enderror">
            <option value="expense" @if ($category->type == 'expense') selected  @endif>支出</option>
            <option value="income"  @if ($category->type == 'income') selected  @endif>收入</option>
        </select>
        @error('category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-6">
          <label for="name" class="block mb-2 text-sm font-medium text-gray-700">
              图标地址
          </label>
          <input type="text" id="icon" name="icon" value="{{ old('icon') }}"
                 class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('icon') border-red-500 @enderror"
                 placeholder="图标地址">
          @error('icon')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
      </div>
      <div class="flex justify-between items-center">
          <button type="submit" class="px-6 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
              保存
          </button>
          <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-800">
              取消
          </a>
      </div>
    </form>
    </div>
</div>
@endsection


@section('scriptsAfterJs')
  <script>
  </script>
@endsection