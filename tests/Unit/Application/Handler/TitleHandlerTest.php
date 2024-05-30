<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Handler;

use App\Application\Handler\TitleHandler;
use App\Domain\Collection\Movies;
use App\Domain\Repository\FileStorageRepository;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TitleHandlerTest extends TestCase
{
    private FileStorageRepository $fileStorageMock;

    protected function setUp(): void
    {
        $this->fileStorageMock = $this->createMock(FileStorageRepository::class);
    }

    #[Test]
    public function getRandomMovies(): void
    {
        $movies = $this->createStub(Movies::class);

        $this->fileStorageMock->expects($this->once())->method('getRandomMovies')->with(3)->willReturn($movies);
        $sut = new TitleHandler($this->fileStorageMock);
        $result = $sut->getRandomMovies(3);

        $this->assertSame($movies, $result);
    }

    #[Test]
    public function filterMoviesWithTitleWordCount(): void
    {
        $movies = $this->createStub(Movies::class);

        $this->fileStorageMock->expects($this->once())->method('getFilterByWordCount')->with(3)->willReturn($movies);
        $sut = new TitleHandler($this->fileStorageMock);
        $result = $sut->filterMoviesWithTitleWordCount(3);

        $this->assertSame($movies, $result);
    }

    #[Test]
    public function filterMoviesByStartingLetterAndEven(): void
    {
        $movies = $this->createStub(Movies::class);

        $this->fileStorageMock->expects($this->once())->method('getMoviesStartingWithAndEven')->with('E')->willReturn($movies);
        $sut = new TitleHandler($this->fileStorageMock);
        $result = $sut->filterMoviesByStartingLetterAndEven('E');

        $this->assertSame($movies, $result);
    }
}
