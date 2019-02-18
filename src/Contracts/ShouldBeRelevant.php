<?php

namespace Coderello\RelevanceEnsurer\Contracts;

interface ShouldBeRelevant
{
    public function isRelevant(): bool;
}
