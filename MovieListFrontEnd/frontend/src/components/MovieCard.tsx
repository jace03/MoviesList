import type {Movie} from "../types";

interface MovieCardProps {
    movie: Movie;
}

export default function MovieCard({ movie }: MovieCardProps) {
    return (
        <div style={{
            border: '1px solid #ddd',
            padding: '15px',
            margin: '10px 0',
            borderRadius: '8px'
        }}>
            <h3>{movie.title}</h3>
            <p>Year: {movie.year}</p>
            <small>ID: {movie.id}</small>
        </div>
    );
}
