<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello daud');
        $this->get('/hello-again')
            ->assertSeeText('Hello daud');

    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World daud');
    }

    public function testTemplate()
    {
    $this->view('/hello', ['name' => 'daud'])
        ->assertSeeText('Hello daud');

        $this->view('/hello.world', ['name' => 'daud'])
            ->assertSeeText('World daud');
    }

}
