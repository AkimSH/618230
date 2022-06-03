<?php
namespace App\Repositories;

use App\Http\ResponseTemp\ApiResponseTemp;
use App\Models\Restaurant;
use App\Repositories\Interfaces\RestaurantRepositoryInterface;
use Illuminate\Support\Facades\Request;
use Spatie\FlareClient\Api;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    protected $restaurant;

    public function __construct(Restaurant $restaurant)
    {
        return $this->restaurant = $restaurant;
    }

    public function index($request)
    {
        if (!empty($request['search']) && !empty($request['sort_by'])) {
            $data = $this->restaurant->searchBy($request['search'])->orderBy($request['sort_by']);
        } elseif (!empty($request['search'])) {
            $data = $this->restaurant->searchBy($request['search']);
        } elseif (!empty($request['sort_by'])) {
            $data = $this->restaurant->orderBy($request['sort_by']);
        } else {
            $data = $this->restaurant;
        }
        return $data->paginate(20);
    }

    public function store($request)
    {
        $restaurant = $this->restaurant::create($request->toArray());

        return ApiResponseTemp::apiResponse(true,['message' => 'Restaurant successfully added', 'restaurant_info' => $restaurant]);
    }

    public function update($request, $restaurant)
    {
        $status = $restaurant->update($request->toArray());

        if ($status) {
            return ApiResponseTemp::apiResponse(true,['message' => 'Successfully updated', 'restaurant_info' => $restaurant]);
        }

        return ApiResponseTemp::apiResponse(false, false);
    }

    public function destroy($restaurant)
    {
        $status = $restaurant->delete();

        if ($status) {
            return ApiResponseTemp::apiResponse(true, ['message' => 'Successfully deleted']);
        }

        return ApiResponseTemp::apiResponse(false, false);
    }

    public function attachCuisine($restaurant, $request)
    {
        if (!$restaurant->cuisines()->where('cuisine_id', '=', $request->cuisine_id)->exists()) {
            $restaurant->cuisines()->attach($request->cuisine_id);

            return ApiResponseTemp::apiResponse(true, ['message' => 'Cuisine relation successfully added']);
        }

        return ApiResponseTemp::apiResponse(false, ['message' => 'Not valid cuisine']);
    }
}
