<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\FileStorage;

use App\Domain\Factory\MoviesFactory;
use App\Infrastructure\Adapters\Secondary\FileStorageAdapter;
use App\Infrastructure\FileStorage\Service;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    private FileStorageAdapter $fileStorageClient;
    private MoviesFactory $moviesFactory;

    protected function setUp(): void
    {
        $this->fileStorageClient = $this->createMock(FileStorageAdapter::class);
        $this->moviesFactory = $this->createMock(MoviesFactory::class);
    }

    #[Test]
    public function getFilterByWordCount(): void
    {
        $this->fileStorageClient->expects($this->once())->method('getTitlesWithWordCount')->with(3);
        $this->moviesFactory->expects($this->once())->method('createFrom');

        $sut = new Service($this->fileStorageClient, $this->moviesFactory);
        $result = $sut->getFilterByWordCount(3);
    }

    #[Test]
    public function getMoviesStartingWithAndEven(): void
    {
        $this->moviesFactory->expects($this->once())->method('createFrom');
        $this->fileStorageClient->expects($this->once())->method('startingWithTitles');

        $sut = new Service($this->fileStorageClient, $this->moviesFactory);
        $result = $sut->getMoviesStartingWithAndEven('W');
    }

    #[Test]
    public function getRandomMovies(): void
    {
        $this->fileStorageClient->expects($this->once())->method('getRandomTitles');
        $this->moviesFactory->expects($this->once())->method('createFrom');

        $sut = new Service($this->fileStorageClient, $this->moviesFactory);
        $result = $sut->getRandomMovies(3);
    }
}
