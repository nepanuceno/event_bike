<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
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
        // dd($_SERVER['HTTP_ACCEPT_LANGUAGE']);
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);
            if (count($lang_parse[1])){
              $langs = array_combine($lang_parse[1], $lang_parse[4]);

                foreach ($langs as $lang => $val){
                  if ($val === ''){
                      $langs[$lang] = 1;

                      if ($lang =='pt-BR')
                        App::setLocale('pt_BR');
                  }
                }
                arsort($langs, SORT_NUMERIC);
            }
        }

        if (session()->get('language')) {
            App::setLocale(session()->get('language'));
        }

        return $next($request);
    }
}
