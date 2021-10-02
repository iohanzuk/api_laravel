<?php

namespace Tests\Unit\Repositories;

use App\Models\Developer;
use App\Repositories\DeveloperRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeveloperRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    private $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->initDatabase();

        $this->repository = new DeveloperRepository();
    }

    public function tearDown(): void
    {
        $this->resetDatabase();
        parent::tearDown();
    }

    /** @test */
    public function shouldCreateDeveloperInDataBase()
    {
        $developer = Developer::factory()->make();
        $result = $this->repository->create($developer->toArray());

        $this->assertInstanceOf(Developer::class, $result);
        $this->assertNotEmpty($result->id);
        $this->assertSame($developer->nome, $result->nome);

    }
}
