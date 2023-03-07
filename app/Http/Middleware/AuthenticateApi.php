<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateApi extends Middleware
{
    protected function authenticate($request, array $guards)
    {

        $token = $request->bearerToken();



        if(isset($token)){

            $apis = ApiToken::all();
//        dd($apis);

            foreach ($apis as $api_token){
                if($api_token->token == $token){
                    return;
                }
            }
        }

        $this->unauthenticated($request, $guards);
    }
}
