<?php

namespace Coderello\RelevanceEnsurer\Listeners;

use Illuminate\Queue\Events\JobProcessing;
use Coderello\RelevanceEnsurer\Contracts\ShouldBeRelevantJob;

class EnsureJobRelevance
{
    public function handle(JobProcessing $event)
    {
        if ($event->job instanceof ShouldBeRelevantJob) {
            return $event->job->isRelevant();
        }

        return true;
    }
}
