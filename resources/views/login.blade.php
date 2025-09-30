
@extends('layouts.app')
@section('title', '注册')

@section('content')
<style>
.demo-login-container{width: 320px; margin: 21px auto 0;}
.demo-login-other .layui-icon{position: relative; display: inline-block; margin: 0 2px; top: 2px; font-size: 26px;}
</style>
<form class="layui-form" action="/login" method="POST">
  @csrf
  <div class="demo-login-container">
    <div class="layui-form-item">
      <div class="layui-input-wrap">
        <div class="layui-input-prefix">
          <i class="layui-icon layui-icon-email"></i>
        </div>
        <input type="text" name="email" value="" lay-verify="required" placeholder="邮箱" lay-reqtext="请填写邮箱" autocomplete="off" class="layui-input" lay-affix="clear">
      </div>
    </div>
    <div class="layui-form-item">
      <div class="layui-input-wrap">
        <div class="layui-input-prefix">
          <i class="layui-icon layui-icon-password"></i>
        </div>
        <input type="password" name="password" value="" lay-verify="required" placeholder="密   码" lay-reqtext="请填写密码" autocomplete="off" class="layui-input" lay-affix="eye">
      </div>
    </div>
    <div class="layui-form-item">
      <input type="checkbox" name="remember" lay-skin="primary" title="记住密码">
      <a href="#forget" style="float: right; margin-top: 7px;">忘记密码？</a>
    </div>
    <div class="layui-form-item">
      <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="demo-login">登录</button>
    </div>
    <div class="layui-form-item demo-login-other">
      <label>社交账号登录</label>
      <span style="padding: 0 21px 0 6px;">
        <a href="javascript:;"><i class="layui-icon layui-icon-login-qq" style="color: #3492ed;"></i></a>
        <a href="javascript:;"><i class="layui-icon layui-icon-login-wechat" style="color: #4daf29;"></i></a>
        <a href="javascript:;"><i class="layui-icon layui-icon-login-weibo" style="color: #cf1900;"></i></a>
      </span>
      或 <a href="/register">注册帐号</a>
    </div>
  </div>
</form>
@endsection


@section('scriptsAfterJs')
  <script>
  </script>
@endsection