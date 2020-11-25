<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CourseWizardMiddleware
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
        
        if( auth()->user()->courses->find(( app('request')->route('course')))->status != -1 ){
            return redirect('courses/{course}/summary');
        }

        return $next($request);
    }
}
