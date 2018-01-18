<?php

namespace App\Http\Middleware;

use Closure;

class CheckData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $model)
    {
        $model_class = 'App\Models\\' . ucfirst($model);
        $id = substr($model, 0, 1) . '_id';
        $data = (new $model_class)->checkAndGet($request->{$id});
        if (!$data) {
            return response()->json([
                'code' => 0,
                'message' => 'data not found'
            ]);
        }
        $request->$model = $data;
        return $next($request);
    }
}
