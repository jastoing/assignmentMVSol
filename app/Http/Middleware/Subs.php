<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Subs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $subs = $user->subs()->get();
        $slugs = [];
        foreach ($subs as $sub) {
            foreach (unserialize($sub->pages) as $page) {
                $slugs[]=$page['slug'];
            }
        }
        if (in_array($request->slug, $slugs)) {
            return $next($request);
        }else{
            abort(403);
        }

        
    }
}
