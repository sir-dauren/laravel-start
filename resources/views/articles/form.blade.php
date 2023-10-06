@extends('layouts.app')

@section('title', 'Добавить статью')

@section('content')

    @include('shared.header', ['title' => 'Добавить статью'])

    <div class="container mx-auto">
        
        <a href="{{ route('articles.index') }}" class="text-indigo-600 hover:text-indigo-900 my-5 block">
            Вернуться назад
        </a>

        <form action="{{ $article->exists ? route('articles.update', $article) : route('articles.store')}}" 
            method="POST" enctype="multipart/form-data">
            @csrf
            @method($article->exists ? 'PUT' : 'POST')

            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Заголовок</label>
                            <input type="text" name="title"
                             class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm 
                             sm:text-sm border-gray-300 @error('title') border-red-300 @enderror rounded-md" value="{{ old('title',$article) }}">
                            
                             @error('title')
                                <div class="text-red-500 mt-2">{{ $message }}</div>                                
                             @enderror


                        </div>

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Автор</label>

                            
                            <select name="user_id" 
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 @error('user_id') border-red-300 @enderror rounded-md">
                                @foreach($users as $id => $name)
                                    <option value="{{ $id }}" @selected((int)old('user_id',$article)===$id)>{{$name}}</option>
                                @endforeach
                            </select>
                            
        
                            @error('user_id')
                                <div class="text-red-500 mt-2">{{ $message }}</div>                                
                             @enderror
                        </div>

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Текст</label>
                            <input type="text" name="text" value="{{ old('text', $article) }}"
                             class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm 
                             sm:text-sm border-gray-300 @error('text') border-red-300 @enderror rounded-md">

                            @error('text')
                                <div class="text-red-500 mt-2">{{ $message }}</div>                                
                             @enderror
                        </div>

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Обложка</label>
                            <input type="file" name="thumbnail">

                            @error('thumbnail')
                                <div class="text-red-500 mt-2">{{ $message }}</div>                                
                             @enderror
                        </div>

                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Добавить
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection