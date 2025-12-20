import React from 'react';
import { useParams, Link, useNavigate } from 'react-router-dom';
import { useMovie } from '../hooks/useMovie';
import { useDeleteMovie } from '../hooks/useMovies';

export default function MovieDetail() {
  const { id } = useParams<{ id: string }>();
  const { data: movie, isLoading, error } = useMovie(id);
  const deleteMovie = useDeleteMovie();
  const nav = useNavigate();

  const handleDelete = async () => {
    if (!confirm('Are you sure you want to delete this movie?')) return;
    await deleteMovie.mutateAsync(id!);
    nav('/');
  };

  if (isLoading) return <div className="p-4">Loading...</div>;
  if (error) return <div className="p-4 text-red-400">{error.message}</div>;
  if (!movie) return <div className="p-4">Movie not found</div>;

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="max-w-2xl mx-auto bg-gray-800 rounded-lg p-6 text-white">
        <div className="flex justify-between items-center mb-6">
          <h1 className="text-3xl font-bold">Movie Details</h1>
          <Link to="/" className="text-gray-300 hover:text-white">← Back to Movies</Link>
        </div>

        <h2 className="text-2xl font-semibold mb-3">{movie.title}</h2>

        <div className="flex gap-2 mb-4">
          {movie.genre && <span className="px-3 py-1 rounded-full bg-blue-900 text-blue-200">{movie.genre}</span>}
          {movie.rating && <span className="px-3 py-1 rounded-full bg-purple-900 text-purple-200">rating: {movie.rating}</span>}
          {movie.holiday && <span className="px-3 py-1 rounded-full bg-green-900 text-green-200">{movie.holiday}</span>}
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <h3 className="text-sm text-gray-400 uppercase mb-1">Decade</h3>
            <p className="text-lg">{movie.decade ?? 'Not specified'}</p>
          </div>
          <div>
            <h3 className="text-sm text-gray-400 uppercase mb-1">Rating</h3>
            <p className="text-lg">{movie.rating ?? 'N/A'}</p>
          </div>
          <div>
            <h3 className="text-sm text-gray-400 uppercase mb-1">Holiday</h3>
            <p className="text-lg">{movie.holiday ?? 'No holiday association'}</p>
          </div>
          <div>
            <h3 className="text-sm text-gray-400 uppercase mb-1">Added</h3>
            <p className="text-lg">{movie.created_at ? new Date(movie.created_at).toLocaleDateString() : 'Not available'}</p>
          </div>
        </div>

        {movie.description && (
          <div className="mt-4 bg-gray-900 p-4 rounded">
            <p className="text-gray-300">{movie.description}</p>
          </div>
        )}

        <div className="mt-6 flex gap-3">
          <Link to={`/movies/${movie.id}/edit`} className="bg-green-600 px-4 py-2 rounded">Edit Movie</Link>
          <button onClick={handleDelete} className="bg-red-600 px-4 py-2 rounded">Delete Movie</button>
        </div>

        <div className="text-xs text-gray-500 mt-4">
          Last updated: {movie.updated_at ? new Date(movie.updated_at).toLocaleString() : 'Not available'}
        </div>
      </div>
    </div>
  );
}

