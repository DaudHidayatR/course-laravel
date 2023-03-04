<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvirementTest extends TestCase
{
    public function testGetEnv()
    {
    $youtube = env('YOUTUBE');

    self::assertEquals("Daud Hidayat Ramadhan",$youtube);
    }
    public function testDefaultEnv()
    {
        $youtube = Env::get('AUTHOR','Daud');

        self::assertEquals("Daud",$youtube);
    }
}
