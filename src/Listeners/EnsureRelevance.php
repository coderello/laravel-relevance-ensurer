<?php

namespace Coderello\RelevanceEnsurer\Listeners;

use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Notifications\Events\NotificationSending;
use Coderello\RelevanceEnsurer\Contracts\ShouldBeRelevant;

class EnsureRelevance
{
    public function handle($event)
    {
        if ($event instanceof NotificationSending) {
            $notification = $event->notification;

            if ($notification instanceof ShouldBeRelevant) {
                return $notification->isRelevant();
            }
        } elseif ($event instanceof JobProcessing) {
            $job = $event->job;

            if ($job instanceof ShouldBeRelevant) {
                return $job->isRelevant();
            }
        }

        return true;
    }
}
