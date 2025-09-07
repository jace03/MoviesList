@extends('layouts.app')

@section('content')
    <div class="overflow-x-auto bg-gray-900 rounded-lg shadow">
        <div class="max-w-6xl mx-auto py-6">
            <h1 class="text-2xl font-semibold text-gray-100 mb-4">All Movies</h1>

            <a href="{{ route('movies.create') }}"
               class="mb-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                + Add Movie
            </a>


            <form method="GET" action="{{ route('movies.index') }}" class="mb-6 flex flex-wrap gap-4 items-center">
                <input
                    type="text"
                    name="search"
                    value="{{ old('search', $search) }}"
                    placeholder="Search by title or genre..."
                    class="p-2 border rounded bg-gray-800 text-white placeholder-gray-500 w-full sm:w-1/2"
                />

                <select name="genre" onchange="this.form.submit()" class="p-2 border rounded bg-gray-800 text-white">
                    <option value="">All Genres</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre }}" {{ $genre === $activeGenre ? 'selected' : '' }}>
                            {{ $genre }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">
                    Search
                </button>
            </form>
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-400">Rating</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-400">Title</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-400">Genre</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-400">Holiday</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-400">Description</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-400">Actors</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-400">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                @forelse ($movies as $movie)
                    <tr class="hover:bg-gray-700">
                        <td class="px-4 py-2 text-sm text-gray-300">{{ $movie->getRating() ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-300">{{ $movie->getTitle() ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-300">{{ $movie->getGenre() ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-300">{{ $movie->getHoliday() ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-300">{{ $movie->getDescription() ?? '' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-300">
                            @if ($movie->getActors()->count())
                                {{ implode(', ', $movie->getActors()->map(fn($actor) => $actor->getName())->toArray()) }}
                            @else
                                <span class="italic text-gray-500">No actors listed</span>
                            @endif

                        </td>

                        <td class="px-4 py-2 text-sm text-gray-300 space-x-2">
                            <a href="{{ route('movies.show', $movie->getId()) }}"
                               class="text-blue-400 hover:text-blue-600">View</a>
                            <a href="{{ route('movies.edit', $movie->getId()) }}"
                               class="text-yellow-400 hover:text-yellow-600">Edit</a>
                            <form action="{{ route('movies.destroy', $movie->getId()) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-400 hover:text-red-600"
                                        onclick="return confirm('Delete this movie?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-400">No movies found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-6">
                {{ $paginator->withQueryString()->links() }}
            </div>

        </div>
    </div>
@endsection
<script>
    const movieId = @json($movie->getId());
</script>

<script src="{{ asset('javascript/actor-inputs.js') }}"></script>
