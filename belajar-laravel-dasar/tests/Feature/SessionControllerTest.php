<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateSession()
    {
        $this->get('/session/create')
            ->assertSeeText("ok")
            ->assertSessionHas("userId", "Daud")
            ->assertSessionHas("isMember", true);
    }
    public function testGetSession()
    {
        $this->withSession([
            'userId' => 'daud',
            'isMember' => 'true'
        ])->get('/session/get')
            ->assertSeeText('User Id: daud, Is Member :true');
    }
    public function testGetGuestSession(){
        $this->get('/session/get')
            ->assertSeeText('User Id: guest, Is Member :false');
    }
}
