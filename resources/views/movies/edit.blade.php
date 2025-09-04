{{-- resources/views/movies/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-gray-800 rounded-lg shadow-md p-6 text-white">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Edit Movie</h1>
                <a href="{{ route('movies.index') }}" class="text-gray-300 hover:text-white">
                    ← Back to Movies
                </a>
            </div>

            @if ($errors->any())
                <div class="bg-red-900 border border-red-600 text-red-200 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('movies.update', $movie->getId()) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium mb-2">Title</label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title', $movie->getTitle()) }}"
                           class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="genre" class="block text-sm font-medium mb-2">Genre</label>
                    <input type="text" name="genre" id="genre"
                           value="{{ old('genre', $movie->getGenre()) }}"
                           class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="decade" class="block text-sm font-medium mb-2">Decade</label>
                    <input type="text" name="decade" id="decade"
                           value="{{ old('decade', $movie->getDecade()) }}"
                           class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="rank" class="block text-sm font-medium mb-2">Rank</label>
                    <select name="rank" id="rank"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Select Rank</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ old('rank', $movie->getRank()) == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium mb-2">Note</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $movie->getDescription()) }}</textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update Movie
                    </button>
                    <a href="{{ route('movies.index') }}"
                       class="flex-1 text-center bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
