<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Collection;

use App\Domain\Collection\Movies;
use App\Domain\Movie;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MoviesTest extends TestCase
{
    #[Test]
    public function current(): void
    {
        $movie1 = $this->createStub(Movie::class);
        $movie2 = $this->createStub(Movie::class);

        $sut = new Movies([$movie1, $movie2]);
        $result = $sut->current();

        $this->assertSame($movie1, $result);
    }

    #[Test]
    public function next(): void
    {
        $movie1 = $this->createStub(Movie::class);
        $movie2 = $this->createStub(Movie::class);

        $sut = new Movies([$movie1, $movie2]);
        $sut->next();
        $result = $sut->current();

        $this->assertSame($movie2, $result);
    }

    #[Test]
    public function rewind(): void
    {
        $movie1 = $this->createStub(Movie::class);
        $movie2 = $this->createStub(Movie::class);

        $sut = new Movies([$movie1, $movie2]);
        $sut->next();
        $sut->rewind();
        $result = $sut->current();

        $this->assertSame($movie1, $result);
    }

    #[Test]
    public function key(): void
    {
        $movie1 = $this->createStub(Movie::class);
        $movie2 = $this->createStub(Movie::class);

        $sut = new Movies([$movie1, $movie2]);
        $result = $sut->key();

        $this->assertSame(0, $result);
    }

    #[Test]
    public function valid(): void
    {
        $movie1 = $this->createStub(Movie::class);
        $movie2 = $this->createStub(Movie::class);

        $sut = new Movies([$movie1, $movie2]);
        $result1 = $sut->valid();
        $this->assertTrue($result1);

        $sut->next();
        $result2 = $sut->valid();
        $this->assertTrue($result2);

        $sut->next();
        $result3 = $sut->valid();
        $this->assertFalse($result3);
    }
}
