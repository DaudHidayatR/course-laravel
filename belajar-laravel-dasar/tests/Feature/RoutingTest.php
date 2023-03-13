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

    public function testParameter()
    {
        $this->get('/products/1')
            ->assertStatus(200)
            ->assertSeeText('Product 1');
        $this->get('/products/2')
            ->assertStatus(200)
            ->assertSeeText('Product 2');
        $this->get('/products/2/items/1')
            ->assertStatus(200)
            ->assertSeeText('Product 2, item 1');
    }

    public function testRouteParameterRegex()
    {
    $this->get('/categories/100')
        ->assertStatus(200)
        ->assertSeeText('Category 100');
    $this->get('/categories/daud')
        ->assertStatus(200)
        ->assertSeeText('404 By Daud Hidayat Ramadhan');
    }

    public function testRouteParameterOptional()
    {
    $this->get('/users/daud')
        ->assertStatus(200)
        ->assertSeeText('User daud');
    $this->get('/users/')
        ->assertStatus(200)
        ->assertSeeText('User 404');
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/hidayat')
            ->assertStatus(200)
            ->assertSeeText('name hidayat');
        $this->get('/conflict/daud')
            ->assertSeeText('conflict daud');
    }


}
