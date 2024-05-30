<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Factory;

use App\Domain\Factory\MoviesFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MoviesFactoryTest extends TestCase
{
    #[Test]
    public function createFrom(): void
    {
        $sut = new MoviesFactory();
        $result = $sut->createFrom(['a', 'b c', 'd', 'e f g']);

        $this->assertSame('a', $result->current()->title->name);

        $result->next();
        $this->assertSame('b c', $result->current()->title->name);
    }
}
