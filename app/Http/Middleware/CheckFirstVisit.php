<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFirstVisit
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->session()->has('first_visit')) {
            $request->session()->put('first_visit', true);
            $request->session()->put('show_loader', true);
        } else {
            $request->session()->put('show_loader', false);
        }
        return $next($request);
    }
}
