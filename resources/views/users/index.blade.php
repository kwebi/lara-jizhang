@extends('layouts.app')
@section('title', '账户列表')

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
      <th>邮件</th>  
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
    @forelse($users as $user)
      <tr>
        <th>{{$user->id}}</th>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>
           <!-- 编辑按钮 - 跳转到编辑页面 -->
        <a href="{{ route('users.edit', $user) }}" class="layui-btn layui-btn-xs">编辑</a>
        
        <!-- 删除按钮 - 触发删除表单 -->
        <button lay-on="test-confirm" id="{{ $user->id }}"
                class="layui-btn layui-btn-danger layui-btn-xs">删除</button>
        
        <!-- 隐藏的删除表单 -->
        <form id="delete-form-{{ $user->id }}" 
              action="{{ route('users.destroy', $user) }}" 
              method="POST" 
              class="hidden">
            @csrf
            @method('DELETE')
        </form>
        </td>
      </tr>
      
    @empty
    
    @endforelse
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
      var userId = this.id
      layer.confirm('确定要删除这个分类吗？此操作不可恢复！', {icon: 3}, function(){
        document.getElementById('delete-form-' + userId).submit();
        layer.msg('点击确定的回调', {icon: 1});
      }, function(){
        layer.msg('点击取消的回调');
      });
    },
  })
});
  </script>
@endsection