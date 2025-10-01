@extends('layouts.app')
@section('title', '创建账户')

@section('content')

<!-- 给容器追加 class="layui-form-pane"，即可显示为方框风格 -->
<form class="layui-form layui-form-pane mt-10" method="POST" action="{{route('accounts.update', $account)}}" method="POST">
  @csrf
  @method('PUT')
  <div class="layui-form-item">
      <label class="layui-form-label">名称</label>
      <div class="layui-input-inline">
        <input type="text" name="name" value="{{$account->name}}"  autocomplete="off" class="layui-input">
      </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">类型</label>
      <div class="layui-input-inline">
        <input type="text" name="type" value="{{$account->type}}" id="date1" autocomplete="off" class="layui-input">
      </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">余额</label>
    <div class="layui-input-inline">
      <input type="text" name="balance" value="{{$account->balance}}" autocomplete="off" placeholder=""  lay-verify="required" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button type="submit" class="layui-btn" lay-submit lay-filter="account-submit">提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>
<script>
layui.use(['form'], function(){
  var form = layui.form;
  var layer = layui.layer;
  // 提交事件
  form.on('submit(account-submit)', function(data){
    var field = data.field; // 获取表单字段值
    // 显示填写结果，仅作演示用
    console.log(JSON.stringify(field));
    
    // 此处可执行 Ajax 等操作
    // …
    return true; // 阻止默认 form 跳转
  });
});
</script>


@endsection


@section('scriptsAfterJs')
<script>
  layui.use(['form', 'laydate', 'util'], function(){
  var form = layui.form;
  var layer = layui.layer;
  var laydate = layui.laydate;
  var util = layui.util;
  
  // 自定义验证规则
  form.verify({
    pass: function(value) {
      if (!/(.+){6,12}$/.test(value)) {
        return '密码必须 6 到 12 位';
      }
    }
  });
  
  // 指定开关事件
  form.on('switch(switchTest)', function(data){
    layer.msg('开关 checked：'+ (this.checked ? 'true' : 'false'), {
      offset: '6px'
    });
    layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是 ON|OFF', data.othis)
  });
  
  // 提交事件
  form.on('submit(demo1)', function(data){
    var field = data.field; // 获取表单字段值
    // 显示填写结果，仅作演示用
    layer.alert(JSON.stringify(field), {
      title: '当前填写的字段值'
    });
    // 此处可执行 Ajax 等操作
    // …
    return false; // 阻止默认 form 跳转
  });
  
  // 日期
  laydate.render({
    elem: '#date'
  });
  
  // 普通事件
  util.on('lay-on', {
    // 获取验证码
    "get-vercode": function(othis){
      var isvalid = form.validate('.demo-phone'); // 主动触发验证，v2.7.0 新增 
      // 验证通过
      if(isvalid){
        layer.msg('手机号规则验证通过');
        // 此处可继续书写「发送验证码」等后续逻辑
        // …
      }
    }
  });
  });
</script>
@endsection