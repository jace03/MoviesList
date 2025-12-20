import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { useMovies, useDeleteMovie } from '../hooks/useMovies';
import MovieRow from '../components/MovieRow';

export default function MoviesList() {
  const [search, setSearch] = useState('');
  const { data: movies, isLoading, error } = useMovies({ search });
  const del = useDeleteMovie();

  const handleDelete = async (id: number) => {
    if (!confirm('Delete this movie?')) return;
    await del.mutateAsync(id);
  };

  return (
    <div className="container mx-auto px-4 py-6">
      <div className="flex justify-between items-center mb-4">
        <h1 className="text-2xl font-semibold">All Movies</h1>
        <Link to="/movies/new" className="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
          + Add Movie
        </Link>
      </div>

      <div className="mb-4 flex gap-2">
        <input
          value={search}
          onChange={e => setSearch(e.target.value)}
          placeholder="Search by title or genre..."
          className="p-2 border rounded bg-gray-800 text-white flex-1"
        />
      </div>

      {isLoading && <div>Loading...</div>}
      {error && <div className="text-red-400">{error.message}</div>}

      <div className="overflow-x-auto bg-gray-900 rounded-lg shadow">
        <table className="min-w-full">
          <thead className="bg-gray-800 text-gray-400">
            <tr>
              <th className="p-2 text-left">Rating</th>
              <th className="p-2 text-left">Title</th>
              <th className="p-2 text-left">Genre</th>
              <th className="p-2 text-left">Holiday</th>
              <th className="p-2 text-left">Actors</th>
              <th className="p-2 text-left">Actions</th>
            </tr>
          </thead>
          <tbody>
            {movies?.map(m => (
              <MovieRow key={m.id} movie={m} onDelete={() => handleDelete(m.id)} />
            )) || <tr><td className="p-4 text-gray-400">No movies found.</td></tr>}
          </tbody>
        </table>
      </div>
    </div>
  );
}

