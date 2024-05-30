<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\UI\Controller;

use App\Application\Handler\TitleHandler;
use App\Infrastructure\UI\Controller\Movie;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;

class MovieTest extends TestCase
{
    private TitleHandler $titleHandler;
    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        $this->titleHandler = $this->createMock(TitleHandler::class);
        $this->serializer = $this->createMock(SerializerInterface::class);
    }

    #[Test]
    public function randomTitles(): void
    {
        $this->titleHandler->expects($this->once())->method('getRandomMovies')->with(3);
        $this->serializer->expects($this->once())->method('serialize');

        $sut = new Movie($this->titleHandler, $this->serializer);
        $result = $sut->randomTitles();

        $this->assertSame(200, $result->getStatusCode());
    }

    #[Test]
    public function withWordCount(): void
    {
        $this->titleHandler->expects($this->once())->method('filterMoviesWithTitleWordCount')->with(2);
        $this->serializer->expects($this->once())->method('serialize');

        $sut = new Movie($this->titleHandler, $this->serializer);
        $result = $sut->withWordCount();

        $this->assertSame(200, $result->getStatusCode());
    }

    #[Test]
    public function startingWith(): void
    {
        $this->titleHandler->expects($this->once())->method('filterMoviesByStartingLetterAndEven')->with('W');
        $this->serializer->expects($this->once())->method('serialize');

        $sut = new Movie($this->titleHandler, $this->serializer);
        $result = $sut->startingWith();

        $this->assertSame(200, $result->getStatusCode());
    }
}
