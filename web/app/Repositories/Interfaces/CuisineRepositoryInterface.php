<?php
namespace App\Repositories\Interfaces;

interface CuisineRepositoryInterface
{
    public function index($request);

    public function store($request);

    public function update($request, $cuisine);

    public function destroy($cuisine);

    public function attachRestaurant($cuisine, $request);
}
