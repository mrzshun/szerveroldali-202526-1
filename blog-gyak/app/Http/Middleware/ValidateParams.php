<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateParams
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $num = $request->route()->parameters['num'];
        $str = $request->route()->parameters['str'];
        $opt = isset($request->route()->parameters['opt']) ? $request->route()->parameters['opt'] : null;
        $errors = [];
        if(!filter_var($num,FILTER_VALIDATE_INT)) {
            $errors['num'] = 'A $num-nak pozitív egész számnak kell lennie!';
        }
        if(!is_string($str)) {
            $errors['str'] = 'A $str-nak szövegnek kell lennie!';
        }
        if(!empty($errors)) {
            return response()->json($errors,418);
        }
        return $next($request);
    }
}
