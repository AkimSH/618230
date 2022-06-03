<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cuisine;
use App\Repositories\CuisineRepository;
use Illuminate\Http\Request;

class CuisineController extends Controller
{
    protected $cuisineRepository;

    public function __construct(CuisineRepository $cuisineRepository)
    {
        $this->cuisineRepository = $cuisineRepository;
    }

    public function index(Request $request)
    {
        $restaurants = $this->cuisineRepository->index($request);
        return $restaurants;
    }

    public function store(Request $request)
    {
        $request->validate([
            'cuisine_name' => 'required'
        ]);

        return $this->cuisineRepository->store($request);
    }

    public function update(Cuisine $cuisine, Request $request)
    {
        $request->validate([
            'cuisine_name' => 'required'
        ]);

        return $this->cuisineRepository->update($request, $cuisine);
    }

    public function destroy(Cuisine $cuisine)
    {
        return $this->cuisineRepository->destroy($cuisine);
    }

    public function attachRestaurant(Cuisine $cuisine, Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required'
        ]);

        $cuisine->load('restaurants');
        return $this->cuisineRepository->attachRestaurant($cuisine, $request);
    }
}
