<?php

namespace MovieDetail;

use App\Dto\MovieDetail;
use App\Livewire\MovieDetailComponent;
use App\Models\MovieRating;
use App\Services\MovieDetailService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Mockery\MockInterface;
use Tests\TestCase;

class MovieDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_movie_detail_will_be_shown(): void
    {
        $this->mockMovieDetailService();

        $response = $this
            ->actAsAuthenticatedUser()
            ->get(route('movie-detail', ['imdbID' => 'tt0000000']));

        $response->assertStatus(200);
        $response->assertSeeLivewire(MovieDetailComponent::class);
        $response->assertSee('Wieder so ein Film');
        $response->assertSee('18.08.2006');
        $response->assertSee('JarJar Abrahams');
        $response->assertSee('Drehbuchautor');
        $response->assertSee('Testy McTestface, Max Mustermann');
        $response->assertSee('Blabla irgendeine honchinteressante Geschichte blabla...');
        $response->assertSee('https://test.test/lalabild.jpg');
    }

    public function test_set_movie_rating(): void
    {
        $this->mockMovieDetailService();
        $this->actAsAuthenticatedUser();

        Livewire::test(MovieDetailComponent::class, ['imdbID' => 'tt0000000'])
            ->call('setRating', 5);

        $movieRating = MovieRating::query()->where('movie_ratings.imdb_id', '=', 'tt0000000')->first();
        $this->assertNotNull($movieRating);
        $this->assertEquals(5, $movieRating->rating);
    }

    private function mockMovieDetailService(): void
    {
        $this->partialMock(MovieDetailService::class, function (MockInterface $mock) {
            $mock->shouldReceive('getDetail')->andReturn(MovieDetail::fromArray([
                'imdbID' => 'tt0000000',
                'Title' => 'Wieder so ein Film',
                'Year' => '2006',
                'Released' => '18 Aug 2006',
                'Genre' => 'Comedy, Drama',
                'Director' => 'JarJar Abrahams',
                'Writer' => 'Drehbuchautor',
                'Actors' => 'Testy McTestface, Max Mustermann',
                'Plot' => 'Blabla irgendeine honchinteressante Geschichte blabla...',
                'Poster' => 'https://test.test/lalabild.jpg',
            ]));
        });
    }
}
