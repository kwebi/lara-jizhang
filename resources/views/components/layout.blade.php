<!-- resources/views/components/layout.blade.php -->
<!-- 添加下面的 CDN -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script src="{{asset('cdn/tailwindcss3.4.js')}}"></script>
    <script src="{{asset('cdn/alpine.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('cdn/daisyui-full.min.css') }}">
    
    <title>{{ $title ?? 'Laravel App' }}</title>
</head>
<body class="min-h-screen bg-gray-50">
    <!-- 导航栏 -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                

                <!-- 导航菜单 -->
                <div class="hidden md:flex md:items-center md:space-x-4">
                    <a href="/" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">首页</a>
                    @if(auth()->user())
                        <!-- 已登录状态 -->
                        <div class="flex items-center space-x-4">
                            <!-- 通知按钮 -->
                            <button class="relative p-1 text-gray-600 hover:text-indigo-600 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </button>

                            <!-- 用户信息 -->
                            <div class="relative group">
                                <button class="flex items-center space-x-2 text-sm focus:outline-none">
                                    <span class="text-gray-700">{{ auth()->user()?->name }}</span>
                                </button>
                            </div>

                            <!-- 退出按钮 -->
                            <form action="/logout" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="text-sm text-white bg-indigo-600 px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    退出
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- 未登录状态 -->
                        <div class="flex items-center space-x-4">
                            <a href="/login" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">登录</a>
                            <a href="/register" 
                               class="text-white bg-indigo-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                注册
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- 页面标题 -->
    @if(isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-semibold text-gray-900">{{ $header }}</h1>
            </div>
        </header>
    @endif

    <!-- 主要内容区域 -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>

    <!-- 页脚 -->
    <footer class="bg-white border-t mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Laravel App. All rights reserved.
            </p>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</html>

