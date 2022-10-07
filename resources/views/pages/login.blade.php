@extends('layouts.layout-main')
@section('content')
    <div class="container max-w-screen-xs">
        <div class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-md sm:p-6 md:p-8">
            <form action="/login" method="post" class="space-y-6">
                <h5 class="text-center text-2xl font-medium text-gray-900">Login</h5>
                @if (session()->has('loginError'))
                    <div id="loginError" class="mb-4 flex border-t-2 border-red-500 bg-red-100 p-4" role="alert">
                        <svg class="h-5 w-5 flex-shrink-0 text-red-700" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div class="ml-3 text-sm font-medium text-red-700">
                            {{ session('loginError') }}
                        </div>
                    </div>
                @endif
                @csrf
                <div>
                    <label for="email" class="ml-2 mb-2 block text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-slate-500 focus:ring-slate-500"
                        placeholder="Email" autofocus required>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="ml-2 mb-2 block text-sm font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-slate-500 focus:ring-slate-500"
                        placeholder="Password" required>
                </div>
                <button type="submit"
                    class="w-full rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300">Login</button>
                <div class="m-3">Belum punya akun? <a href="/registration"
                        class="text-blue-600 hover:text-blue-700">Register</a></div>
            </form>
        </div>
    </div>
@endsection
