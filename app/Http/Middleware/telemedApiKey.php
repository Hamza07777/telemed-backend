<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class telemedApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /*abdul code for token*/
$token=$request->header('telemedApiKey');
if($token!=='abcd'){
    return response()->json(['message'=>'Token key is invalid!'],401);
}
         /*end abdul code*/
        return $next($request);
    }
}
