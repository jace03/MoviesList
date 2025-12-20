import { useQuery } from '@tanstack/react-query';
import type { Movie } from '../types';
import * as moviesApi from '../api/movies';

export function useMovie(id?: string | number | undefined) {
  return useQuery<Movie, Error>(['movie', id], () => moviesApi.getMovie(id!), {
    enabled: !!id,
  });
}

