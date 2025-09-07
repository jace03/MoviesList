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

                <div class="mb-4">
                    <label for="holiday" class="block text-sm font-medium mb-2 text-white">Holiday</label>
                    <select
                        name="holiday"
                        id="holiday"
                        class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                        <option value="">Select a holiday</option>
                        @foreach (['Christmas', 'Halloween', 'New Year', 'Easter'] as $holiday)
                            <option value="{{ $holiday }}"
                                {{ old('holiday', isset($movie) ? $movie->getHoliday() : null) === $holiday ? 'selected' : '' }}
                            >
                                {{ $holiday }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-between mb-2">
                    <h4 class="text-lg font-semibold text-white">Actors</h4>
                    <button
                        type="button"
                        id="add-actor-btn"
                        class="text-green-500 text-2xl font-bold leading-none focus:outline-none"
                        title="Add another actor"
                    >+
                    </button>
                </div>
                <div id="actor-inputs" class="space-y-3 mb-4">
                    <input
                        type="text"
                        name="actor_names[]"
                        class="actor-name w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Actor Name"
                    >
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
<script>
    document.getElementById('add-actor-btn').addEventListener('click', function () {
        const container = document.getElementById('actor-inputs');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'actor_names[]';
        input.placeholder = 'Actor Name';
        input.className = 'actor-name w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-blue-500';
        container.appendChild(input);
    });
</script>
@push('scripts')
    <script src="{{ asset('javascript/actor-inputs.js') }}"></script>
@endpush
