<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGeneralTest extends TestCase
{

    public function testURLCurrent()
    {
    $this->get('url/current?name=Daud')
        ->assertSeeText('/url/current?name=Daud');
    }

    public function testNamed()
    {
        $this->get('redirect/named')
            ->assertSeeText('redirect/name/Daud');
    }

    public function testAction()
    {
        $this->get('url/action')
            ->assertSeeText('form');
    }


}
