import React, { useEffect, useState } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import { useCreateMovie, useUpdateMovie } from '../hooks/useMovies';
import { useMovie } from '../hooks/useMovie';
import ActorInputs from '../components/ActorInputs';
import type { MovieCreatePayload } from '../types';

const holidayOptions = ['Christmas', 'Halloween', 'New Year', 'Easter'];

export default function MovieForm() {
  const { id } = useParams<{ id: string }>();
  const isEditing = !!id;
  const { data: movie } = useMovie(id);
  const create = useCreateMovie();
  const update = useUpdateMovie(id);
  const nav = useNavigate();

  const [form, setForm] = useState<MovieCreatePayload>({
    title: '',
    genre: '',
    decade: '',
    rating: '',
    holiday: '',
    description: '',
    actor_names: [''],
  });

  useEffect(() => {
    if (movie) {
      setForm({
        title: movie.title || '',
        genre: movie.genre || '',
        decade: movie.decade || '',
        rating: movie.rating ?? '',
        holiday: movie.holiday || '',
        description: movie.description || '',
        actor_names: movie.actors.length ? movie.actors.map(a => a.name) : [''],
      });
    }
  }, [movie]);

  const handleChange = (k: keyof MovieCreatePayload, v: any) => {
    setForm(prev => ({ ...prev, [k]: v }));
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      if (isEditing) {
        await update.mutateAsync(form);
      } else {
        await create.mutateAsync(form);
      }
      nav('/');
    } catch (err: any) {
      alert(err?.message || 'Error');
    }
  };

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="max-w-md mx-auto bg-gray-800 rounded p-6 text-white">
        <div className="flex justify-between items-center mb-4">
          <h1 className="text-2xl font-bold">{isEditing ? 'Edit Movie' : 'Add New Movie'}</h1>
        </div>

        <form onSubmit={handleSubmit} className="space-y-4">
          <div>
            <label className="block text-sm mb-1">Title</label>
            <input value={form.title} onChange={e => handleChange('title', e.target.value)} className="w-full p-2 bg-gray-900 rounded" />
          </div>

          <div>
            <label className="block text-sm mb-1">Genre</label>
            <input value={form.genre} onChange={e => handleChange('genre', e.target.value)} className="w-full p-2 bg-gray-900 rounded" />
          </div>

          <div>
            <label className="block text-sm mb-1">Decade</label>
            <input value={form.decade} onChange={e => handleChange('decade', e.target.value)} className="w-full p-2 bg-gray-900 rounded" />
          </div>

          <div>
            <label className="block text-sm mb-1">Rating</label>
            <select value={String(form.rating ?? '')} onChange={e => handleChange('rating', e.target.value ? Number(e.target.value) : '')} className="w-full p-2 bg-gray-900 rounded">
              <option value="">Select rating</option>
              {Array.from({ length: 10 }).map((_, i) => <option key={i+1} value={i+1}>{i+1}</option>)}
            </select>
          </div>

          <div>
            <label className="block text-sm mb-1">Holiday</label>
            <select value={form.holiday} onChange={e => handleChange('holiday', e.target.value)} className="w-full p-2 bg-gray-900 rounded">
              <option value="">Select a holiday</option>
              {holidayOptions.map(h => <option key={h} value={h}>{h}</option>)}
            </select>
          </div>

          <div>
            <label className="block text-sm mb-1">Actors</label>
            <ActorInputs value={form.actor_names ?? ['']} onChange={val => handleChange('actor_names', val)} />
          </div>

          <div>
            <label className="block text-sm mb-1">Note</label>
            <textarea value={form.description} onChange={e => handleChange('description', e.target.value)} className="w-full p-2 bg-gray-900 rounded" rows={4} />
          </div>

          <div className="flex gap-3">
            <button type="submit" className="bg-blue-600 px-4 py-2 rounded">{isEditing ? 'Update' : 'Create'}</button>
            <button type="button" onClick={() => nav(-1)} className="bg-gray-600 px-4 py-2 rounded">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  );
}

