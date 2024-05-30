<?php

declare(strict_types=1);

namespace App\Infrastructure\FileStorage;

use App\Domain\Collection\Movies;
use App\Domain\Factory\MoviesFactory;
use App\Domain\Repository\FileStorageRepository;
use App\Infrastructure\Adapters\Secondary\FileStorageAdapter;

readonly class Service implements FileStorageRepository
{
    public function __construct(
        private FileStorageAdapter $fileRepository,
        private MoviesFactory $moviesFactory
    ) {
    }

    public function getFilterByWordCount(int $count): Movies
    {
        $titlesWithWordCount = $this->fileRepository->getTitlesWithWordCount($count);

        return $this->moviesFactory->createFrom($titlesWithWordCount);
    }

    public function getRandomMovies(int $count): Movies
    {
        $randomTitles = $this->fileRepository->getRandomTitles($count);

        return $this->moviesFactory->createFrom($randomTitles);
    }

    public function getMoviesStartingWithAndEven(string $letter): Movies
    {
        $startingWithTitles = $this->fileRepository->startingWithTitles($letter);

        return $this->moviesFactory->createFrom($startingWithTitles);
    }
}
