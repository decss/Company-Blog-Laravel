<?php

namespace App\Providers;

use Blade;
use DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Blade counters
        Blade::directive('set', function($exp) {
            list($name, $value) = explode(',', $exp);

            return "<?php $name = $value; ?>";
        });

        // TEST: show queries
        // DB::listen(function($query) {
        //     dump($query->sql);
        //     // echo "<h1>{$query->sql}</h1>";
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
