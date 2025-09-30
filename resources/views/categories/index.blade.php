@extends('layouts.app')
@section('title', '分类列表')

@section('content')
<div class="overflow-x-auto w-full">


  <table class="table w-full">
    <!-- head -->
    <thead>
      <tr>
        <th>序号</th>
        <th>名称</th>
        <th>类型</th>        
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <!-- row 1 -->
    @forelse($categories as $category)
      <tr>
        <th>{{$category->id}}</th>
        <td>{{$category->icon}} {{$category->name}}</td>
        <td>{{$category->type}}</td>
        <td>
           <!-- 编辑按钮 - 跳转到编辑页面 -->
        <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary mr-3">编辑</a>
        
        <!-- 删除按钮 - 触发删除表单 -->
        <button onclick="confirmDelete({{ $category->id }})" 
                class="btn btn-danger">删除</button>
        
        <!-- 隐藏的删除表单 -->
        <form id="delete-form-{{ $category->id }}" 
              action="{{ route('categories.destroy', $category) }}" 
              method="POST" 
              class="hidden">
            @csrf
            @method('DELETE')
        </form>
        </td>
      </tr>
      <tr>
      @if($category->children->count())
        @foreach($category->children as $child)
          <th>{{$child->id}}</th>
          <td>{{$child->icon}} {{$child->name}}</td>
          <td>{{$child->type}}</td>
          
          <td>
           <!-- 编辑按钮 - 跳转到编辑页面 -->
          <a href="{{ route('categories.edit', $child) }}" class="btn btn-primary mr-3">编辑</a>
          <!-- 删除按钮 - 触发删除表单 -->
          <button onclick="confirmDelete({{ $child->id }})" 
                class="btn btn-danger">删除</button>
          <!-- 隐藏的删除表单 -->
          <form id="delete-form-{{ $child->id }}" 
              action="{{ route('categories.destroy', $child) }}" 
              method="POST" 
              class="hidden">
            @csrf
            @method('DELETE')
          </form>
          </td>
          @endforeach
            
        @else
            
        @endif
      </tr>
    @empty
    
    @endforelse
    </tbody>
  </table>
  
</div>
<div class="btn-group flex">
    <a href="{{route('categories.create')}}">
      <button class="btn" >新增 </button>
    </a>
</div>
@endsection


@section('scriptsAfterJs')
  <script>
    function confirmDelete(categoryId) {
      if (confirm('确定要删除这个分类吗？此操作不可恢复！')) {
        document.getElementById('delete-form-' + categoryId).submit();
      }
    }
  </script>
@endsection