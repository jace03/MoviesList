export interface Movie {
    id: number;
    title: string;
    genre: string;
    decade: string;
    holiday: string | null;
    rating: number;
    description?: string | null;
    created_at?: string;
    updated_at?: string;
}

export interface MovieFormData {
    title: string;
    genre: string;
    decade: string;
    holiday: string;
    rating: number;
    description?: string;
}
