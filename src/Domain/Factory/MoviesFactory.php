<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Collection\Movies;
use App\Domain\Movie;
use App\Domain\VO\Title;

class MoviesFactory
{
    /**
     * @param array<int, string> $titles
     */
    public function createFrom(array $titles): Movies
    {
        $tmpArray = [];

        foreach ($titles as $title) {
            $titleVO = new Title($title);
            $tmpArray[] = new Movie($titleVO);
        }

        return new Movies($tmpArray);
    }
}
