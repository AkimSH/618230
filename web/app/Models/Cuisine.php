<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    use HasFactory;

    protected $fillable = ['cuisine_name'];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_cuisine');
    }

    public function searchBy($search_data)
    {
        return self::with('restaurants')
            ->where('cuisine_name', 'LIKE', "%{$search_data}%");
    }
}
