<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class UpdateSortData
{
    public function handle($request, Closure $next)
    {
        $queryData = [
            'sort' => $request->query('sort') ? $request->query('sort') : '',
            'direction' => $request->query('direction') ? $request->query('direction') : '',
            'page' => $request->query('page') ? $request->query('page') : '',
            'route_name' => Route::currentRouteName()
        ];
        
        Inertia::share('sort_data', $queryData);
 
        return $next($request);
    }}