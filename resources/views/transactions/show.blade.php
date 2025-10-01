@extends('layouts.app')
@section('title', '账单列表')

@section('content')

<!-- 给容器追加 class="layui-form-pane"，即可显示为方框风格 -->
<form class="layui-form layui-form-pane mt-10" action="">
  <div class="layui-form-item">
     <div class="layui-inline">
      <label class="layui-form-label">日期</label>
      <div class="layui-input-inline layui-input-wrap">
        <div class="layui-input-prefix">
          <i class="layui-icon layui-icon-date"></i>
        </div>
        <input type="text" name="time" value="{{ $transaction->time->format('Y-m-d') }}" id="date" lay-verify="date" placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
      </div>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">金额</label>
    <div class="layui-input-block">
      <input type="text" name="amount" value="{{ $transaction->amount }}" autocomplete="off" placeholder=""  lay-verify="required" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">分类</label>
      <div class="layui-input-inline">
        <input type="text" name="category" value="{{ $transaction->category->name ?? '' }}"  autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-inline">
      <label class="layui-form-label">标签</label>
      <div class="layui-input-block">
        <input type="text" name="tag" value="{{ $transaction->tag->name ?? '' }}" id="date1" autocomplete="off" class="layui-input">
      </div>
    </div>
    
  </div>
  
  <div class="layui-form-item">
    <label class="layui-form-label">账户</label>
    <div class="layui-input-block">
      <input type="text" name="account" value="{{ $transaction->account->name ?? ''}}" autocomplete="off" placeholder=""  lay-verify="required" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">备注</label>
    <div class="layui-input-block">
      <input type="text" name="note" value="{{$transaction->note ?? ''}}" autocomplete="off" placeholder="" lay-verify="required" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">成员</label>
    <div class="layui-input-block">
      <input type="text" name="member" value="{{ $transaction->memeber->name ?? ''}}" autocomplete="off" placeholder="" lay-verify="required" class="layui-input">
    </div>
  </div>
</form>
<script>
layui.use(['form'], function(){
  var form = layui.form;
  var layer = layui.layer;
  // 提交事件
  form.on('submit(demo2)', function(data){
    var field = data.field; // 获取表单字段值
    // 显示填写结果，仅作演示用
    layer.alert(JSON.stringify(field), {
      title: '当前填写的字段值'
    });
    // 此处可执行 Ajax 等操作
    // …
    return false; // 阻止默认 form 跳转
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