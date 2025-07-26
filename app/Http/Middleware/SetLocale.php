<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $locale = $request->cookie('locale', 'en'); // Default to 'en' if cookie not se
        // $locale = $request->session()->get('locale', 'en'); // Default to 'en' if session not set
        $locale = $request->cookie('locale', 'en');
        if ($locale && in_array($locale, ['en', 'th'])) {
            App::setLocale($locale);
        } else {
            App::setLocale(Config::get('app.locale'));
        }
        return $next($request);
    }
}
