export interface Actor {
  id?: number;
  name: string;
}

export interface Movie {
    id: number;
    title: string;
    year: number;
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
console.log('test');
export type MovieUpdatePayload = Partial<MovieCreatePayload>;

