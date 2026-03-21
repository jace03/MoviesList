import type {Movie} from "../types";

const API_BASE_URL = 'http://localhost:8000/api';

export const movieApi = {
    getAll: async (): Promise<Movie[]> => {
        const response = await fetch(`${API_BASE_URL}/moviesApi`);
        if (!response.ok) {
            throw new Error('Failed to fetch movies');
        }
        return response.json();
    }
};
