<?php

declare(strict_types=1);

namespace App\Tests\Integration\UI\Controller;

use App\Infrastructure\UI\Controller\Movie;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class MovieTest extends KernelTestCase
{
    private Container $container;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->container = static::getContainer();
    }

    #[Test]
    public function randomTitles(): void
    {
        $moviesService = $this->container->get(Movie::class);

        $randomTitles = $moviesService->randomTitles();
        $this->assertSame(200, $randomTitles->getStatusCode());
        $this->assertCount(3, json_decode($randomTitles->getContent()));

        $randomTitles6 = $moviesService->randomTitles(6);
        $this->assertCount(6, json_decode($randomTitles6->getContent()));
    }

    #[Test]
    public function withWordCount(): void
    {
        $sutResult = '[{"title":{"name":"Pulp Fiction"}},{"title":{"name":"Ojciec chrzestny"}},{"title":{"name":"Leon zawodowiec"}},{"title":{"name":"Fight Club"}},{"title":{"name":"Forrest Gump"}},{"title":{"name":"Doktor Strange"}},{"title":{"name":"Szeregowiec Ryan"}},{"title":{"name":"Wielki Gatsby"}},{"title":{"name":"Milczenie owiec"}},{"title":{"name":"Dzie\u0144 \u015bwira"}},{"title":{"name":"Blade Runner"}},{"title":{"name":"Kr\u00f3l Lew"}},{"title":{"name":"Wyspa tajemnic"}},{"title":{"name":"American Beauty"}},{"title":{"name":"Sz\u00f3sty zmys\u0142"}},{"title":{"name":"Mroczny Rycerz"}},{"title":{"name":"Green Mile"}},{"title":{"name":"Truman Show"}},{"title":{"name":"Gran Torino"}},{"title":{"name":"Mroczna wie\u017ca"}},{"title":{"name":"Casino Royale"}},{"title":{"name":"Pi\u0119kny umys\u0142"}},{"title":{"name":"Zielona mila"}},{"title":{"name":"Forest Gump"}},{"title":{"name":"Milczenie owiec"}},{"title":{"name":"Breaking Bad"}},{"title":{"name":"Nagi instynkt"}},{"title":{"name":"Igrzyska \u015bmierci"}},{"title":{"name":"Siedem dusz"}},{"title":{"name":"Dzie\u0144 \u015bwira"}},{"title":{"name":"Wielki Gatsby"}},{"title":{"name":"Sin City"}},{"title":{"name":"Kr\u00f3lowa \u015bniegu"}}]';
        $sut2Result = '[]';

        $moviesService = $this->container->get(Movie::class);

        $sut = $moviesService->withWordCount();
        $this->assertSame(200, $sut->getStatusCode());
        $this->assertSame($sutResult, $sut->getContent());

        $sut2 = $moviesService->withWordCount(8);
        $this->assertSame(200, $sut2->getStatusCode());
        $this->assertSame($sut2Result, $sut2->getContent());
    }

    #[Test]
    public function startingWith(): void
    {
        $sutResult = '[{"title":{"name":"W\u0142adca Pier\u015bcieni: Powr\u00f3t kr\u00f3la"}},{"title":{"name":"Wielki Gatsby"}},{"title":{"name":"Whiplash"}},{"title":{"name":"Wyspa tajemnic"}},{"title":{"name":"W\u0142adca Pier\u015bcieni: Dru\u017cyna Pier\u015bcienia"}},{"title":{"name":"W\u0142adca Pier\u015bcieni: Dwie wie\u017ce"}},{"title":{"name":"Wielki Gatsby"}}]';
        $sut2Result = '[]';

        $moviesService = $this->container->get(Movie::class);

        $sut = $moviesService->startingWith();
        $this->assertSame(200, $sut->getStatusCode());
        $this->assertSame($sutResult, $sut->getContent());

        $sut2 = $moviesService->startingWith('E');
        $this->assertSame(200, $sut2->getStatusCode());
        $this->assertSame($sut2Result, $sut2->getContent());
    }
}
