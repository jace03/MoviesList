import type { Movie, MovieFormData } from '../types/movie';

const API_BASE_URL = 'http://localhost:8000/api';

export const movieService = {
    // Get all movies
    async getAll(): Promise<Movie[]> {
        const response = await fetch(`${API_BASE_URL}/moviesApi`);
        if (!response.ok) throw new Error('Failed to fetch movies');
        return response.json();
    },

    // Get single movie
    async getById(id: number): Promise<Movie> {
        const response = await fetch(`${API_BASE_URL}/movies/${id}`);
        if (!response.ok) throw new Error('Failed to fetch movie');
        return response.json();
},

    // Create movie
    async create(data: MovieFormData): Promise<Movie> {
        const response = await fetch(`${API_BASE_URL}/movies`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
        });
        if (!response.ok) throw new Error('Failed to create movie');
        return response.json();
    },

    // Update movie
    async update(id: number, data: MovieFormData): Promise<Movie> {
        const response = await fetch(`${API_BASE_URL}/movies/${id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
        });
        if (!response.ok) throw new Error('Failed to update movie');
        return response.json();
    },

    // Delete movie
    async delete(id: number): Promise<void> {
        const response = await fetch(`${API_BASE_URL}/movies/${id}`, {
            method: 'DELETE',
        });
        if (!response.ok) throw new Error('Failed to delete movie');
    },

    // Get movies by rating
    async getByRating(rating: number): Promise<Movie[]> {
        const response = await fetch(`${API_BASE_URL}/movies/rating/${rating}`);
        if (!response.ok) throw new Error('Failed to fetch movies by rating');
        return response.json();
    },
};
