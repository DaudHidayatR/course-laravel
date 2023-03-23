<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class contohMiddlewareTest extends TestCase
{

    public function testMiddlewareInvalid()
    {
        $response = $this->get('/middleware/api')
        ->assertStatus(401)
        ->assertSeeText('Access Denied');
    }

    public function testMiddlewareValid()
    {
        $this->withHeader("X-API-KEY", 'DHR')
            ->get('middleware/api')
            ->assertStatus(200)
            ->assertSeeText('ok');
    }
    public function testMiddlewareGroupInvalid()
    {
        $response = $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText('Access Denied');
    }

    public function testMiddlewareGroupValid()
    {
        $this->withHeader("X-API-KEY", 'DHR')
            ->get('middleware/api')
            ->assertStatus(200)
            ->assertSeeText('ok');
    }

}
