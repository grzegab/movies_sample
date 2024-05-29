<?php

declare(strict_types=1);

namespace App\Infrastructure\Adapters\Primary;

use Symfony\Component\HttpFoundation\Response;

interface WordCountTitleAdapter
{
    public function withWordCount(int $count = 2): Response;
}
