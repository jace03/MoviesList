<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Movie extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'movies';

    /**
     * The attributes that are mass assignable.
     */


    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'Decade' => 'string',
        'rank' => 'integer',
    ];

    /**
     * Scope to order by rank
     */
    public function scopeOrderByRank($query)
    {
        return $query->orderBy('rank');
    }

    /**
     * Scope to filter by holiday
     */
    public function scopeByHoliday($query, $holiday)
    {
        return $query->where('holiday', $holiday);
    }

    /**
     * Scope to filter by genre
     */
    public function scopeByGenre($query, $genre)
    {
        return $query->where('genre', 'like', "%{$genre}%");
    }

    /**
     * Get the formatted genre (clean up slashes)
     */
    public function getFormattedGenreAttribute()
    {
        return str_replace('/', ' / ', $this->genre);
    }

    /**
     * Get movies by holiday
     */
    public static function getByHoliday($holiday)
    {
        return static::where('holiday', $holiday)->orderByRank()->get();
    }

    /**
     * Get the next available rank
     */
    public static function getNextRank($holiday = null)
    {
        $query = static::query();

        if ($holiday) {
            $query->where('holiday', $holiday);
        }

        return $query->max('rank') + 1;
    }
}
