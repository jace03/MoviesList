@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-gray-800 rounded-lg shadow-md p-6 text-white">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Add New Movie</h1>
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

            <form action="{{ route('movies.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium mb-2">Title</label>
                    <input type="text"
                           name="title"
                           id="title"
                           value="{{ old('title') }}"
                           class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Enter movie title">
                </div>

                <div class="mb-4">
                    <label for="genre" class="block text-sm font-medium mb-2">Genre</label>
                    <input type="text"
                           name="genre"
                           id="genre"
                           value="{{ old('genre') }}"
                           class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="e.g., Action, Comedy, Drama">
                </div>

                <div class="mb-4">
                    <label for="decade" class="block text-sm font-medium mb-2">Decade</label>
                    <input type="text"
                           name="decade"
                           id="decade"
                           value="{{ old('decade') }}"
                           class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="e.g., 1990">
                </div>

                <div class="mb-4">
                    <label for="rating" class="block text-sm font-medium mb-2">rating</label>
                    <select name="rating"
                            id="rating"
                            class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select rating</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>


                <h4>Actors</h4>
                <div id="actor-inputs">
                    <div class="mb-3">
                        <input type="text"
                               class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 actor-name"
                               placeholder="Actor Name"
                               oninput="handleActorInput(this)">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium mb-2">Note</label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Enter movie description">{{ old('description') }}</textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Create Movie
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

<script src="{{ asset('js/actor-inputs.js') }}"></script>
