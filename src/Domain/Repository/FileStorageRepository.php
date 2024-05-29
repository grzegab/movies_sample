<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Collection\Movies;

interface FileStorageRepository
{
    public function getRandomMovies(int $count): Movies;

    public function getFilterByWordCount(int $count): Movies;

    public function getMoviesStartingWithAndEven(string $letter, bool $even): Movies;
}
