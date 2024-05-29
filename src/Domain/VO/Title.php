<?php

declare(strict_types=1);

namespace App\Domain\VO;

readonly class Title
{
    public function __construct(public string $name)
    {
    }
}
