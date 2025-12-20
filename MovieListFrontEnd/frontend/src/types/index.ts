export interface Actor {
  id?: number;
  name: string;
}

export interface Movie {
  id: number;
  title: string;
  genre?: string | null;
  decade?: string | null;
  rating?: number | null;
  holiday?: string | null;
  description?: string | null;
  actors: Actor[];
  created_at?: string | null;
  updated_at?: string | null;
}

export type MovieCreatePayload = {
  title: string;
  genre?: string;
  decade?: string;
  rating?: number | '';
  holiday?: string;
  description?: string;
  actor_names?: string[];
};

export type MovieUpdatePayload = Partial<MovieCreatePayload>;

