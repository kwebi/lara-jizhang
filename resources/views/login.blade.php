
<x-layout>
  <x-slot:header>用户登录</x-slot:header>
<div class="flex flex-col justify-center px-6 py-12 min-h-full lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto w-auto h-10" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
      <h2 class="mt-10 font-bold tracking-tight text-center text-gray-900 text-2xl/9">登 录</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        
      <form class="space-y-6" action="/login" method="POST">
        @if (session('success')) 
            <div class="alert alert-success">
                {{ session('success') }} 
            </div>
        @endif
        <label class="input input-bordered flex items-center gap-2 @error('email') input-error @enderror">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
            <path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
            <path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
          </svg>
          <input type="text" class="grow" placeholder="邮箱" name="email" value="{{ old('email') }}" />
        </label>
        @error('email')
        <div class="text-white alert alert-error">{{ $message }}</div>
        @enderror
        <label class="input input-bordered flex items-center gap-2 @error('password') input-error @enderror">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
            <path
              fill-rule="evenodd"
              d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
              clip-rule="evenodd" />
          </svg>
          <input type="password" class="grow" name="password" placeholder="密码" value="{{ old('password') }}" />
        </label>
        @error('password')
        <div class="text-white alert alert-error">{{ $message }}</div>
        @enderror
        <div>
          <button
            type="submit"
            class="flex justify-center px-3 py-1.5 w-full font-semibold text-white bg-indigo-600 rounded-md shadow-sm text-sm/6 hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            登 录
          </button>
        </div>
        @csrf
      </form>
    </div>
  </div>
</x-layout>