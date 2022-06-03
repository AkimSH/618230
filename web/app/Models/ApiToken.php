<?php
namespace App\Models;

use Illuminate\Support\Str;

trait ApiToken
{
    public function generateApiToken()
    {
        $token = Str::random(60);
        self::update([
            $this->api_token = $token
        ]);
        return $token;
    }
}
