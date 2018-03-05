<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    protected $fillable = [
    	'session_id', 'ip', 'browser'
    ];	

    public static function get()
    {
      $stats = [];
      $browsers = Stats::groupBy('browser')->pluck('browser');
      foreach ($browsers as $browser) {
        $quantity = Stats::where('browser', $browser)->count();
        $stats[] = ['browser' => $browser, 'quantity' => $quantity];
      }

      return $stats;
    }
}
