<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
    $this->get('response/hello')
        ->assertStatus(200)
        ->assertSeeText('hello response');
    }

    public function testHeader()
    {
    $this->get('/response/header')
        ->assertStatus(200)
        ->assertSeeText('daud')
        ->assertSeeText('ramadhan')
        ->assertHeader('Content-Type', 'application/json')
        ->assertHeader('Author', 'Daud Hidayat Ramadhan')
        ->assertHeader('App', 'Laravel');
    }

    public function testView()
    {
    $this->get('/response/type/view')
        ->assertSeeText('Hello daud');
    }
    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                'firstname' => 'daud',
                'lastname' => 'ramadhan'
            ]);
    }
    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }
    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('LogoDHR.png');
    }
}
