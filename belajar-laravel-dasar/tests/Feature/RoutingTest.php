<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $response = $this->get('/daud')
            ->assertStatus(200)
            ->assertSeeText('Hello Daud Hidayat Ramadhan');
    }
    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/daud');
    }
    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertSeeText('404 By Daud Hidayat Ramadhan');
    }
}
