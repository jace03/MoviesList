import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import type { Movie, MovieCreatePayload, MovieUpdatePayload } from '../types';
import * as moviesApi from '../api/movies';

export function useMovies(params?: Record<string, any>) {
  return useQuery<Movie[], Error>(['movies', params], () => moviesApi.getMovies(params));
}

export function useCreateMovie() {
  const qc = useQueryClient();
  return useMutation((data: MovieCreatePayload) => moviesApi.createMovie(data), {
    onSuccess: () => qc.invalidateQueries(['movies']),
  });
}

export function useUpdateMovie(id?: number | string) {
  const qc = useQueryClient();
  return useMutation((data: MovieUpdatePayload) => moviesApi.updateMovie(id!, data), {
    onSuccess: () => {
      qc.invalidateQueries(['movies']);
      qc.invalidateQueries(['movie', id]);
    },
  });
}

export function useDeleteMovie() {
  const qc = useQueryClient();
  return useMutation((id: number | string) => moviesApi.deleteMovie(id), {
    onSuccess: () => qc.invalidateQueries(['movies']),
  });
}

