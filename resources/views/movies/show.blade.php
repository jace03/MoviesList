{{-- resources/views/movies/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-gray-800 rounded-lg shadow-md p-6 text-white">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Movie Details</h1>
                <a href="{{ route('movies.index') }}" class="text-gray-300 hover:text-white">
                    ← Back to Movies
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-900 border border-green-600 text-green-200 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-6">
                <div>
                    <h2 class="text-2xl font-semibold mb-3">{{ $movie->getTitle() }}</h2>
                    <div class="flex flex-wrap gap-2">
                        @if($movie->getGenre())
                            <span class="inline-block bg-blue-900 text-blue-200 text-sm px-3 py-1 rounded-full">
                                {{ str_replace('/', ' / ', $movie->getGenre()) }}
                            </span>
                        @endif

                        @if($movie->getrating())
                            <span class="inline-block bg-purple-900 text-purple-200 text-sm px-3 py-1 rounded-full">
                                rating: {{ $movie->getrating() }}
                            </span>
                        @endif

                        @if($movie->getHoliday())
                            <span class="inline-block bg-green-900 text-green-200 text-sm px-3 py-1 rounded-full">
                                {{ $movie->getHoliday() }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-1">Decade</h3>
                        <p class="text-lg">{{ $movie->getDecade() ?? 'Not specified' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-1">rating</h3>
                        <p class="text-lg">{{ $movie->getrating() ?? 'Not ratinged' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-1">Holiday</h3>
                        <p class="text-lg">{{ $movie->getHoliday() ?? 'No holiday association' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-1">Added</h3>
                        <p class="text-lg">
                            {{ $movie->getCreatedAt() ? $movie->getCreatedAt()->format('M d, Y') : 'Not available' }}
                        </p>
                    </div>
                </div>

                @if($movie->getDescription())
                    <div>
                        <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-2">Description</h3>
                        <div class="bg-gray-900 rounded-lg p-4">
                            <p class="text-gray-300 leading-relaxed">{{ $movie->getDescription() }}</p>
                        </div>
                    </div>
                @endif

                <div class="border-t border-gray-700 pt-6">
                    <div class="flex gap-4">
                        <a href="{{ route('movies.edit', $movie->getId()) }}"
                           class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition-colors">
                            Edit Movie
                        </a>

                        <form action="{{ route('movies.destroy', $movie->getId()) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition-colors"
                                    onclick="return confirm('Are you sure you want to delete this movie?')">
                                Delete Movie
                            </button>
                        </form>
                    </div>
                </div>

                <div class="text-xs text-gray-500 border-t border-gray-700 pt-4">
                    <p>
                        Last updated:
                        {{ $movie->getUpdatedAt() ? $movie->getUpdatedAt()->format('M d, Y \a\t g:i A') : 'Not available' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
