<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\ResponseTemp\ApiResponseTemp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request, User $user)
    {
        $token = $user
                    ->saveUser($request)
                    ->generateApiToken();

        return ApiResponseTemp::auth(true, ['bearer' => $token]);
    }


    public function login(Request $request)
    {
        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        if (Auth::guard('web')->attempt($credentials)) {
            $token = Auth::guard('web')
                        ->user()
                        ->generateApiToken();

            return ApiResponseTemp::auth(true, ['bearer' => $token]);
        }

        return ApiResponseTemp::auth(false, 401);
    }

    public function logout()
    {
        $user = Auth::guard('api')->user();
        $user->update([
            'api_token' => null
        ]);

        return ApiResponseTemp::logout();
    }
}
