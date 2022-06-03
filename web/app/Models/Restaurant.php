<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_name'];

    public function cuisines()
    {
        return $this->belongsToMany(Cuisine::class, 'restaurant_cuisine');
    }

    public function searchBy($search_data)
    {
        return self::with('cuisines')
            ->where('restaurant_name', 'LIKE', "%{$search_data}%");
    }
}
