@extends('layouts.layout-main')
@section('content')
  <div class="container max-w-screen-xs">
    <div class="w-full rounded-lg border border-gray-200 bg-white p-4 sm:p-6 md:p-8 shadow-md">
      <form action="/registration" method="post" class="space-y-6">
        <h5 class="text-center text-2xl font-medium text-gray-900">Registrasi</h5>
        @csrf
        <div>
          <label for="name" class="ml-2 mb-2 block text-sm font-medium text-gray-900">Nama</label>
          <input type="text" name="name" id="name"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-slate-500 focus:ring-slate-500"
            value="{{ old('name') }}" placeholder="Nama Lengkap" autofocus required>
          @error('name')
            <p class="mt-2 text-sm text-red-600"><span class="font-medium">{{ $message }}</span></p>
          @enderror
        </div>
        <div>
          <label for="email" class="ml-2 mb-2 block text-sm font-medium text-gray-900">Email</label>
          <input type="text" name="email" id="email"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-slate-500 focus:ring-slate-500"
            value="{{ old('email') }}" placeholder="Nama Lengkap" autofocus required>
          @error('email')
            <p class="mt-2 text-sm text-red-600"><span class="font-medium">{{ $message }}</span></p>
          @enderror
        </div>
        <div>
          <label for="password" class="ml-2 mb-2 block text-sm font-medium text-gray-900">Password</label>
          <input type="password" name="password" id="password"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-slate-500 focus:ring-slate-500"
              value="{{ old('password') }}" placeholder="Password" required>
        </div>
        <button type="submit"
          class="w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300">
          Registrasi
        </button>
        <div class="m-3">Sudah punya akun?
          <a href="/login" class="text-blue-600 hover:text-blue-700">Login</a>
        </div>
      </form>
    </div>
  </div>
@endsection
