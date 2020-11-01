<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Currency extends Model
{
    //
    public function getActive() {
        $currencies = DB::table('currency')
                    ->where('is_enabled', '=', 1)->orderByRaw('case when code=980 then 1 else name end')->get();
        return $currencies;
        //return $this;
    }
 }
