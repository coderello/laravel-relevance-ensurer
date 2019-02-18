<?php

namespace Coderello\RelevanceEnsurer;

use Illuminate\Support\Facades\Event;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Notifications\Events\NotificationSending;
use Coderello\RelevanceEnsurer\Listeners\EnsureJobRelevance;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Coderello\RelevanceEnsurer\Listeners\EnsureNotificationRelevance;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(JobProcessing::class, EnsureJobRelevance::class);
        Event::listen(NotificationSending::class, EnsureNotificationRelevance::class);
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
