<?php

namespace App\Http\ResponseTemp;

class ApiResponseTemp
{
    public static function auth($success, $data)
    {
        if ($success){
            return self::successRespond($data);
        }

        return self::errorRespond($data);
    }

    public static function logout()
    {
        return self::successRespond(['message' => 'You have successfully logged out!']);
    }

    public static function apiResponse($success ,$data)
    {
        if ($success) {
            return self::successRespond($data);
        }

        return self::errorRespond(500, $data);
    }

    protected static function successRespond($data = null)
    {
        $response = [
            'success' => true,
            'code' => 200
        ];

        if ($data !== null){
            $response['data'] = $data;
        }

        return response()->json($response);
    }

    protected static function errorRespond($code, $data = null)
    {
        $response = [
            'success' => false,
            'code' => $code
        ];

        if ($data !== null){
            $response['data'] = $data;
        }

        return response()->json($response);
    }

}
