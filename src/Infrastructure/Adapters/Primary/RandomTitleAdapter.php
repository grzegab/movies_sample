<?php

declare(strict_types=1);

namespace App\Infrastructure\Adapters\Primary;

use Symfony\Component\HttpFoundation\Response;

interface RandomTitleAdapter
{
    public function randomTitles(int $count = 3): Response;
}
