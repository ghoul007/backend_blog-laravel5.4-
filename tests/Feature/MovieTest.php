<?php

namespace Tests\Feature;

use App\Movie;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MovieTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {


       Movie::create([
            "name" => "demo",
            "title" => "movie1",
            "description" => "description 1",
            "user_id"=>1]);

        $this->assertEquals(1, Movie::count());
    }
}
