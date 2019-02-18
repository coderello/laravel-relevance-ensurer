<?php

namespace Coderello\RelevanceEnsurer\Contracts;

interface ShouldBeRelevantNotification
{
    public function isRelevant($notifiable): bool;
}
