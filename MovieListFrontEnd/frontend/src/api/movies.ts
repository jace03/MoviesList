import axios from 'axios';
import type { Movie, MovieCreatePayload, MovieUpdatePayload } from '../types';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL ?? '/',
  headers: { 'Content-Type': 'application/json' },
  withCredentials: true,
});

export async function getMovies(params?: Record<string, any>): Promise<Movie[]> {
  const res = await api.get('/api/movies', { params });
  return res.data;
}

export async function getMovie(id: string | number): Promise<Movie> {
  const res = await api.get(`/api/movies/${id}`);
  return res.data;
}

export async function createMovie(payload: MovieCreatePayload): Promise<Movie> {
  const res = await api.post('/api/movies', payload);
  return res.data;
}

export async function updateMovie(id: string | number, payload: MovieUpdatePayload): Promise<Movie> {
  const res = await api.put(`/api/movies/${id}`, payload);
  return res.data;
}

export async function deleteMovie(id: string | number): Promise<void> {
  await api.delete(`/api/movies/${id}`);
}

