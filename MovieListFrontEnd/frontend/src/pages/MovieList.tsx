import { useState, useEffect } from 'react';
import { movieService } from '../services/movieService';
import type { Movie } from '../types/movie';
import { Link } from 'react-router-dom';

export default function MoviesList() {
    const [movies, setMovies] = useState<Movie[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);
    const [selectedHoliday, setSelectedHoliday] = useState<string>('');
    const [selectedGenre, setSelectedGenre] = useState<string>('');

    useEffect(() => {
        loadMovies();
    }, []);

    const loadMovies = async () => {
        try {
            setLoading(true);
            const data = await movieService.getAll();
            setMovies(data);
            setError(null);
        } catch (err) {
            setError(err instanceof Error ? err.message : 'Failed to load movies');
        } finally {
            setLoading(false);
        }
    };

    const handleDelete = async (id: number) => {
        if (!confirm('Delete this movie?')) return;

        try {
            await movieService.delete(id);
            setMovies(movies.filter(m => m.id !== id));
        } catch (err) {
            alert('Failed to delete movie');
        }
    };

    const filteredMovies = movies.filter(movie => {
        if (selectedHoliday && movie.holiday !== selectedHoliday) return false;
        if (selectedGenre && movie.genre !== selectedGenre) return false;
        return true;
    });

    const uniqueGenres = [...new Set(movies.map(m => m.genre))];

    if (loading) return <div className="text-center py-8">Loading movies...</div>;
    if (error) return <div className="text-red-500 text-center py-8">{error}</div>;

    return (
        <div className="max-w-6xl mx-auto p-6 bg-gray-900 min-h-screen">
            <div className="flex justify-between items-center mb-6">
                <h1 className="text-3xl font-bold text-white">All Movies</h1>
                <Link
                    to="/movies/create"
                    className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
                >
                    + Add Movie
                </Link>
            </div>

            {/* Filters */}
            <div className="flex gap-4 mb-6">
                <select
                    value={selectedHoliday}
                    onChange={(e) => setSelectedHoliday(e.target.value)}
                    className="p-2 border rounded bg-gray-800 text-white"
                >
                    <option value="">All Holidays</option>
                    <option value="Halloween">Halloween</option>
                    <option value="Christmas">Christmas</option>
                </select>

                <select
                    value={selectedGenre}
                    onChange={(e) => setSelectedGenre(e.target.value)}
                    className="p-2 border rounded bg-gray-800 text-white"
                >
                    <option value="">All Genres</option>
                    {uniqueGenres.map(genre => (
                        <option key={genre} value={genre}>{genre}</option>
                    ))}
                </select>
            </div>

            {/* Table */}
            <table className="min-w-full divide-y divide-gray-700 bg-gray-800">
                <thead>
                <tr>
                    <th className="px-4 py-2 text-left text-sm font-medium text-gray-400">Rating</th>
                    <th className="px-4 py-2 text-left text-sm font-medium text-gray-400">Title</th>
                    <th className="px-4 py-2 text-left text-sm font-medium text-gray-400">Genre</th>
                    <th className="px-4 py-2 text-left text-sm font-medium text-gray-400">Decade</th>
                    <th className="px-4 py-2 text-left text-sm font-medium text-gray-400">Holiday</th>
                    <th className="px-4 py-2 text-left text-sm font-medium text-gray-400">Actions</th>
                </tr>
                </thead>
                <tbody className="divide-y divide-gray-700">
                {filteredMovies.map((movie) => (
                    <tr key={movie.id} className="hover:bg-gray-700">
                        <td className="px-4 py-2 text-sm text-gray-300">{movie.rating}</td>
                        <td className="px-4 py-2 text-sm text-gray-300">{movie.title}</td>
                        <td className="px-4 py-2 text-sm text-gray-300">{movie.genre}</td>
                        <td className="px-4 py-2 text-sm text-gray-300">{movie.decade}</td>
                        <td className="px-4 py-2 text-sm text-gray-300">{movie.holiday || 'N/A'}</td>
                        <td className="px-4 py-2 text-sm space-x-2">
                            <Link to={`/movies/${movie.id}`} className="text-blue-400 hover:underline">
                                View
                            </Link>
                            <Link to={`/movies/${movie.id}/edit`} className="text-yellow-400 hover:underline">
                                Edit
                            </Link>
                            <button
                                onClick={() => handleDelete(movie.id)}
                                className="text-red-400 hover:underline"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>

            {filteredMovies.length === 0 && (
                <p className="text-center text-gray-400 py-8">No movies found</p>
            )}
        </div>
    );
}
