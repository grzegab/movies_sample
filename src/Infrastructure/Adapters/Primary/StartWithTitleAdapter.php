<?php

declare(strict_types=1);

namespace App\Infrastructure\Adapters\Primary;

use Symfony\Component\HttpFoundation\Response;

interface StartWithTitleAdapter
{
    public function startingWith(string $startingLetter = 'W', bool $even = true): Response;
}
