<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use App\Stats;
use UserAgentParser\Provider\WhichBrowser;
use View;

class SetStats
{
    public function handle($request, Closure $next)
    {
        $this_session = session()->getId();
        $wb = new WhichBrowser();
        if (!Stats::where('session_id', $this_session)->first()) {
          $ip = $_SERVER['REMOTE_ADDR']; //get_ip
          $result = $wb->parse($_SERVER['HTTP_USER_AGENT']); //get all headers
          $browser = $result->getBrowser()->getName(); //get browser_name from headers
          // write to DB
          $stats = New Stats();
          
          $stats->session_id = $this_session;
          $stats->ip = $ip;
          $stats->browser = $browser; 

          $stats->save();
        }
        // sent stats to all views
        $stats = Stats::get();
        View::share('stats', $stats);

        return $next($request);

    }
}
