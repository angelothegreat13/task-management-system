@extends('layouts.master')

@section('content')
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        autofocus
                        autocomplete="email" 
                        value="{{ old('email') }}"
                        class="@error('email') border-red-500 @else border-gray-300 @enderror w-full rounded-md border bg-white text-sm text-gray-700 shadow-sm py-3 px-4"
                    >
                    @error('email')
                        <p class="tracking-wide text-red-500 text-sm mt-2 mb-0 italic">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <div class="mt-2">
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        autocomplete="current-password" 
                        class="@error('password') border-red-500 @else border-gray-300 @enderror w-full rounded-md border bg-white text-sm text-gray-700 shadow-sm py-3 px-4"
                    >
                    @error('password')
                        <p class="tracking-wide text-red-500 text-sm mt-2 mb-0 italic">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
            </div>
        </form>
    </div>
</div>
@endsection
