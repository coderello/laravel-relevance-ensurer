<?php

namespace Coderello\RelevanceEnsurer\Contracts;

interface ShouldBeRelevantJob
{
    public function isRelevant(): bool;
}
