<?php
namespace App\Repositories\Interfaces;

interface RestaurantRepositoryInterface
{
    public function index($request);

    public function store($request);

    public function update($request, $restaurant);

    public function destroy($restaurant);

    public function attachCuisine($restaurant, $request);
}
