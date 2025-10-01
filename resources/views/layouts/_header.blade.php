<ul class="layui-nav flex">
  <li class="layui-nav-item"><a href="{{route('transactions.index')}}">首页</a></li>
  
  @if(auth()->user())
  <li class="layui-nav-item" ><a href="{{route('categories.index')}}">分类</a></li>

  <li class="layui-nav-item">
    <a href="javascript:;">{{ auth()->user()?->name }}</a>
  </li>
  <li class="layui-nav-item">
    <form action="/logout" method="POST" class="inline">
      @csrf
      <button type="submit" class="text-sm px-4 py-2 rounded-md  ">
        退出
      </button>
    </form>
  </li>
  @else
  <li class="layui-nav-item" ><a href="/login">登录</a></li>
  <li class="layui-nav-item" ><a href="/register">注册</a></li>
  @endif
</ul>

