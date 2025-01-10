@extends('layouts.index')

@section('title', 'Register')

@section('content')
<div class="h-screen flex items-center justify-center">
    <div class="relative">
        <div class="absolute -top-3 -left-3 -right-3 -bottom-3 rounded-lg bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 shadow-lg animate-pulse"></div>
        <div id="form-container" class="bg-white p-20 rounded-lg shadow-2xl w-[28rem] relative z-10 transform transition duration-500 ease-in-out">
            <h2 id="form-title" class="text-center text-4xl font-bold mb-12 text-gray-800">Register</h2>
            <form method="POST" action="{{ route('users.register') }}" class="space-y-6">
                @csrf
                <input 
                    class="w-full h-14 border border-gray-800 px-4 rounded-lg text-lg" 
                    placeholder="Full Name" 
                    id="name" 
                    name="name" 
                    type="text" 
                    required 
                />
                <input 
                    class="w-full h-14 border border-gray-800 px-4 rounded-lg text-lg" 
                    placeholder="Email" 
                    id="email" 
                    name="email" 
                    type="email" 
                    required 
                />
                <input 
                    class="w-full h-14 border border-gray-800 px-4 rounded-lg text-lg" 
                    placeholder="Password" 
                    id="password" 
                    name="password" 
                    type="password" 
                    required 
                />
                <input 
                    class="w-full h-14 border border-gray-800 px-4 rounded-lg text-lg" 
                    placeholder="Confirm Password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    required 
                />
                <select 
                    class="w-full h-14 border border-gray-800 px-4 rounded-lg text-lg" 
                    id="role" 
                    name="role" 
                    required
                >
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button 
                    class="w-full h-14 bg-blue-500 hover:bg-blue-700 text-white font-bold text-lg py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    Register
                </button>
                <div class="flex justify-between items-center">
                    <a class="text-blue-500 hover:text-blue-800 text-sm" href="{{ route('users.login') }}">Already have an account? Login!</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
