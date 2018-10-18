<?php 

namespace App\Http\Middleware;

use Closure, Session;
use Illuminate\Support\Facades\Auth;

class LocalLanguage {

    /**
     * The availables languages.
     *
     * @array $languages
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::get('locale'))
        {
            app()->setLocale(Session::get('local_language'));
        }
        return $next($request);
    }
}
