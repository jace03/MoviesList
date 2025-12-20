import React from 'react';
import { Link } from 'react-router-dom';
import type { Movie } from '../types';

export default function MovieRow({ movie, onDelete }: { movie: Movie; onDelete?: () => void }) {
  return (
    <tr className="hover:bg-gray-800">
      <td className="p-2">{movie.rating ?? 'N/A'}</td>
      <td className="p-2">{movie.title}</td>
      <td className="p-2">{movie.genre}</td>
      <td className="p-2">{movie.holiday}</td>
      <td className="p-2">{movie.actors?.map(a => a.name).join(', ') || <span className="italic text-gray-500">No actors</span>}</td>
      <td className="p-2 space-x-2">
        <Link to={`/movies/${movie.id}`} className="text-blue-400">View</Link>
        <Link to={`/movies/${movie.id}/edit`} className="text-yellow-400">Edit</Link>
        <button onClick={onDelete} className="text-red-400">Delete</button>
      </td>
    </tr>
  );
}

