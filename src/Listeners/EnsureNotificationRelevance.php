<?php

namespace Coderello\RelevanceEnsurer\Listeners;

use Illuminate\Notifications\Events\NotificationSending;
use Coderello\RelevanceEnsurer\Contracts\ShouldBeRelevantNotification;

class EnsureNotificationRelevance
{
    public function handle(NotificationSending $event)
    {
        if ($event->notification instanceof ShouldBeRelevantNotification) {
            return $event->notification->isRelevant($event->notifiable);
        }

        return true;
    }
}
