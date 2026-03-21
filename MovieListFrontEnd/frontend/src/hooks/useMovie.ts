import { useQuery } from '@tanstack/react-query';
import type { Movie } from '../types';
import * as moviesApi from '../api/movies';

export function useMovie(id?: string | number | undefined) {
    return useQuery<Movie, Error>({
        queryKey: ['movie', id],
        queryFn: () => moviesApi.getMovie(id!),
        enabled: !!id
    });
}
