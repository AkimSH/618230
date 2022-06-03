<?php
namespace App\Repositories;

use App\Http\ResponseTemp\ApiResponseTemp;
use App\Models\Cuisine;
use App\Models\User;
use App\Repositories\Interfaces\CuisineRepositoryInterface;

class CuisineRepository implements CuisineRepositoryInterface
{
    protected $cuisine;

    public function __construct(Cuisine $cuisine)
    {
        $this->cuisine = $cuisine;
    }

    public function index($request)
    {
        if (!empty($request['search']) && !empty($request['sort_by'])) {
            $data = $this->cuisine->searchBy($request['search'])->orderBy($request['sort_by']);
        } elseif (!empty($request['search'])) {
            $data = $this->cuisine->searchBy($request['search']);
        } elseif (!empty($request['sort_by'])) {
            $data = $this->cuisine->orderBy($request['sort_by']);
        } else {
            $data = $this->cuisine;
        }
        return $data->paginate(20);
    }

    public function store($request)
    {
        $restaurant = $this->cuisine::create($request->toArray());

        return ApiResponseTemp::apiResponse(true,['message' => 'Cuisine successfully added', 'cuisine_info' => $restaurant]);
    }

    public function update($request, $cuisine)
    {
        $status = $cuisine->update($request->toArray());

        if ($status) {
            return ApiResponseTemp::apiResponse(true,['message' => 'Successfully updated', 'cuisine_info' => $cuisine]);
        }

        return ApiResponseTemp::apiResponse(false, false);
    }

    public function destroy($cuisine)
    {
        $status = $cuisine->delete();

        if ($status) {
            return ApiResponseTemp::apiResponse(true, ['message' => 'Successfully deleted']);
        }

        return ApiResponseTemp::apiResponse(false, false);
    }

    public function attachRestaurant($cuisine, $request)
    {
        if (!$cuisine->restaurants()->where('restaurant_id', '=', $request->restaurant_id)->exists()) {
            $cuisine->restaurants()->attach($request->restaurant_id);

            return ApiResponseTemp::apiResponse(true, ['message' => 'Restaurant relation successfully added']);
        }

        return ApiResponseTemp::apiResponse(false, ['message' => 'Not valid restaurant']);
    }
}
