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

            <form method="POST" action="{{ route('movies.update', $movie->getId()) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium mb-2">Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title', $movie->getTitle()) }}"
                        class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                </div>

                <div class="mb-4">
                    <label for="genre" class="block text-sm font-medium mb-2">Genre</label>
                    <input
                        type="text"
                        name="genre"
                        id="genre"
                        value="{{ old('genre', $movie->getGenre()) }}"
                        class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                </div>

                <div class="mb-4">
                    <label for="decade" class="block text-sm font-medium mb-2">Decade</label>
                    <input
                        type="text"
                        name="decade"
                        id="decade"
                        value="{{ old('decade', $movie->getDecade()) }}"
                        class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                </div>

                <div class="mb-4">
                    <label for="rating" class="block text-sm font-medium mb-2">Rating</label>
                    <select
                        name="rating"
                        id="rating"
                        class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                        <option value="">Select rating</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}"
                                {{ old('rating', $movie->getRating()) == $i ? 'selected' : '' }}
                            >
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{--start of actors section--}}
                <h4 class="text-lg font-semibold text-white">Actors</h4>

                <div id="actor-inputs" class="space-y-3 mb-4">
                    @php
                        // collect existing actor names, or start with one blank
                        $oldNames = old('actor_names', $movie->getActors()->map(fn($a) => $a->getName())->toArray());
                        if (empty($oldNames)) {
                            $oldNames = [''];
                        }
                    @endphp

                    @foreach($oldNames as $name)
                        <input
                            type="text"
                            name="actor_names[]"
                            value="{{ $name }}"
                            class="actor-name w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Actor Name"
                        >
                    @endforeach
                </div>

                <button
                    type="button"
                    id="add-actor-btn"
                    class="text-green-500 text-2xl font-bold leading-none focus:outline-none"
                    title="Add another actor"
                >+
                </button>
                {{-- End actors section --}}

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium mb-2">Note</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >{{ old('description', $movie->getDescription()) }}</textarea>
                </div>

                <div class="flex gap-4">
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out"
                    >
                        Update Movie
                    </button>
                    <a
                        href="{{ route('movies.index') }}"
                        class="px-4 py-2 bg-gray-600 text-white font-semibold rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-150 ease-in-out"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // expose movieId to actor-inputs.js if needed
        const movieId = @json($movie->getId());
    </script>
@endsection

@push('scripts')
    <script src="{{ asset('javascript/actor-inputs.js') }}"></script>
@endpush
