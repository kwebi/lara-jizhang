@extends('layouts.app')
@section('title', '分类列表')

@section('content')
<div class=" w-full">
<table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="150">
    <col width="200">
  </colgroup>
  <thead>
    <tr>
      <th>序号</th>
      <th>名称</th>
      <th>类型</th>
      <th>父类型</th>        
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
    @forelse($categories as $category)
      <tr>
        <th>{{$category->id}}</th>
        <td>{{$category->icon}} {{$category->name}}</td>
        <td>{{$category->type}}</td>
        <td>{{'一级类型'}}</td>
        <td>
           <!-- 编辑按钮 - 跳转到编辑页面 -->
        <a href="{{ route('categories.edit', $category) }}" class="layui-btn layui-btn-xs">编辑</a>
        
        <!-- 删除按钮 - 触发删除表单 -->
        <button onclick="confirmDelete({{ $category->id }})" 
                class="layui-btn layui-btn-danger layui-btn-xs">删除</button>
        
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
      <tr class="bg-gray-100">
      @if($category->children->count())
        @foreach($category->children as $child)
          <th>{{$child->id}}</th>
          <td>{{$child->icon}} {{$child->name}}</td>
          <td>{{$child->type}}</td>
          <td>{{$child->parent->name}}</td>
          <td>
           <!-- 编辑按钮 - 跳转到编辑页面 -->
          <a href="{{ route('categories.edit', $child) }}" class="layui-btn layui-btn-xs">编辑</a>
          <!-- 删除按钮 - 触发删除表单 -->
          <button lay-on="test-confirm"
                class="layui-btn layui-btn-danger layui-btn-xs">删除</button>
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

    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>
        <div class="btn-group flex">
          <a href="{{route('categories.create')}}">
             <button type="button" class="layui-btn layui-btn-xs layui-btn-normal">新增 </button>
          </a>
        </div>
      </td>
    </tr>
  </tbody>
</table>
</div>

@endsection


@section('scriptsAfterJs')
  <script>
  layui.use(function(){
  var layer = layui.layer;
  var util = layui.util;
  // 事件
  util.on('lay-on', {
    "test-confirm": function(){
      layer.confirm('确定要删除这个分类吗？此操作不可恢复！', {icon: 3}, function(){
        document.getElementById('delete-form-' + categoryId).submit();
        layer.msg('点击确定的回调', {icon: 1});
      }, function(){
        layer.msg('点击取消的回调');
      });
    },
  })
});
  </script>
@endsection