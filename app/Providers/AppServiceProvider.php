<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* // можно включить логи каждого запроса к базе https://codebriefly.com/how-to-log-all-sql-queries-in-laravel/#:~:text=Log%20in%20the%20default%20log,at%20%E2%80%9Capp%2FProviders%E2%80%9D.
        DB::listen(function($query) {
            File::append(
                storage_path('/logs/query.log'),
                '[' . date('Y-m-d H:i:s') . ']' . PHP_EOL . $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL . PHP_EOL
            );
        });
        */
    }
}
