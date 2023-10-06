@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')

    @include('shared.header', ['title' => 'Регистрация'])

    <div class="container mx-auto">
        
        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-900 my-5 block">
            Войти на сайт
        </a>

        <form action="{{ route('register') }}" 
            method="POST">
            @csrf
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">E-mail</label>
                            <input type="email" name="email"
                             class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm 
                             sm:text-sm border-gray-300 @error('email') border-red-300 @enderror rounded-md" value="{{ old('email') }}">
                            
                             @error('email')
                                <div class="text-red-500 mt-2">{{ $message }}</div>                                
                             @enderror


                        </div>


                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Пароль</label>
                            <input type="password" name="password"
                             class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm 
                             sm:text-sm border-gray-300 @error('password') border-red-300 @enderror rounded-md">

                            @error('password')
                                <div class="text-red-500 mt-2">{{ $message }}</div>                                
                             @enderror
                        </div>

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Подтвердите пароль</label>
                            <input type="password" name="password_confirmation"
                             class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm 
                             sm:text-sm border-gray-300 @error('password_confirmation') border-red-300 @enderror rounded-md">

                            @error('password_confirmation')
                                <div class="text-red-500 mt-2">{{ $message }}</div>                                
                             @enderror
                        </div>

                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Регистрация
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection