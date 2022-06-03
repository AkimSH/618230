<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Repositories\RestaurantRepository;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{

    protected $restaurantRepository;

    public function __construct(RestaurantRepository $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    public function index(Request $request)
    {
        $restaurants = $this->restaurantRepository->index($request);
        return $restaurants;
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_name' => 'required'
        ]);

        return $this->restaurantRepository->store($request);
    }

    public function update(Restaurant $restaurant, Request $request)
    {
        $request->validate([
            'restaurant_name' => 'required'
        ]);

        return $this->restaurantRepository->update($request, $restaurant);
    }

    public function destroy(Restaurant $restaurant)
    {
        return $this->restaurantRepository->destroy($restaurant);
    }

    public function attachCuisine(Restaurant $restaurant, Request $request)
    {
        $request->validate([
            'cuisine_id' => 'required'
        ]);

        $restaurant->load('cuisines');
        return $this->restaurantRepository->attachCuisine($restaurant, $request);
    }
}
