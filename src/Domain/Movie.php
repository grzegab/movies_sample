<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\VO\Title;

readonly class Movie
{
    public function __construct(public Title $title)
    {
    }
}
