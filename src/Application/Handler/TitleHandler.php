<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Domain\Collection\Movies;
use App\Domain\Repository\FileStorageRepository;

final readonly class TitleHandler
{
    public function __construct(private FileStorageRepository $fileStorage)
    {
    }

    public function getRandomMovies(int $count): Movies
    {
        return $this->fileStorage->getRandomMovies($count);
    }

    public function filterMoviesWithTitleWordCount(int $count): Movies
    {
        return $this->fileStorage->getFilterByWordCount($count);
    }

    public function filterMoviesByStartingLetterAndEven(string $letter, bool $even): Movies
    {
        return $this->fileStorage->getMoviesStartingWithAndEven($letter, $even);
    }
}
