import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import type { Movie, MovieCreatePayload, MovieUpdatePayload } from '../types';
import * as moviesApi from '../api/movies';

export function useMovies(params?: Record<string, any>) {
    return useQuery<Movie[], Error>({
        queryKey: ['movies', params],
        queryFn: () => moviesApi.getMovies(params)
    });
}

export function useCreateMovie() {
    const qc = useQueryClient();
    return useMutation({
        mutationFn: (data: MovieCreatePayload) => moviesApi.createMovie(data),
        onSuccess: () => qc.invalidateQueries({ queryKey: ['movies'] })
    });
}

export function useUpdateMovie(id?: number | string) {
    const qc = useQueryClient();
    return useMutation({
        mutationFn: (data: MovieUpdatePayload) => moviesApi.updateMovie(id!, data),
        onSuccess: () => {
            qc.invalidateQueries({ queryKey: ['movies'] });
            qc.invalidateQueries({ queryKey: ['movie', id] });
        }
    });
}

export function useDeleteMovie() {
    const qc = useQueryClient();
    return useMutation({
        mutationFn: (id: number | string) => moviesApi.deleteMovie(id),
        onSuccess: () => qc.invalidateQueries({ queryKey: ['movies'] })
    });
}
