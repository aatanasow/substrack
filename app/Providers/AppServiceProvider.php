<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Model::unguard();
        Model::shouldBeStrict();
        Model::automaticallyEagerLoadRelationships();

        Carbon::macro('formattedForHumans', function () {
            return match (floor($this->diffInDays())) {
                0.0 => 'Today',
                1.0 => 'Yesterday',
                -1.0 => 'Tomorrow',
                default => $this->diffForHumans(),
            };
        });
    }
}
