<?php

namespace Coderello\RelevanceEnsurer;

use Illuminate\Support\Facades\Event;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Notifications\Events\NotificationSending;
use Coderello\RelevanceEnsurer\Listeners\EnsureRelevance;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen([
            JobProcessing::class,
            NotificationSending::class,
        ], EnsureRelevance::class);
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
