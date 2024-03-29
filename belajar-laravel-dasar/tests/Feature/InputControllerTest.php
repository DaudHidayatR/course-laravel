<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class InputControllerTest extends TestCase
{

    public function testInput()
    {
        $this->get('/input/hello?name=Daud')
            ->assertSeeText('Hello Daud');

        $this->post('/input/hello', ['name' => 'Daud']
        )->assertSeeText('Hello Daud');
    }

    public function testHelloFirstName()
    {
        $this->post('/input/hello/first', ['name'=> ['first' =>'Daud']
        ])->assertSeeText('Hello Daud');
    }
    public function testInputAll()
    {
        $this->post('input/hello/input', [
            'name' => [
                'first' => 'daud',
                'middle'=> 'hidayat',
                'last' => 'ramadhan'
            ]
        ])->assertSeeText('name')->assertSeeText('first')->assertSeeText('daud')
        ->assertSeeText('middle')->assertSeeText('hidayat')
        ->assertSeeText('last')->assertSeeText('ramadhan');
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple Mac Book Pro",
                    "price" => 30000000
                ],
                [
                    "name" => "Samsung Galaxy S10",
                    "price" => 15000000
                ]
            ]
        ])->assertSeeText("Apple Mac Book Pro")
            ->assertSeeText("Samsung Galaxy S10");
    }
    public  function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'daud',
            'married'=> 'false',
            'birth_date', '2002-11-28'
        ])->assertSeeText('daud')->assertSeeText('false')->assertSeeText('2002-11-28');
    }

    public function testFilterOny()
    {
    $this->post('/input/filter/only', [
        'name'=>[
            'first' => 'daud',
            'middle' => 'hidayat',
            'last' => 'ramadhan'
        ],

    ])->assertSeeText('daud')->assertSeeText('ramadhan')
        ->assertDontSee('hidayat');
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            'username'=> 'daud',
            'admin' => 'true',
            'password' => 'rahasia'
        ])->assertSeeText('daud')->assertSeeText('rahasia')
            ->assertDontSee('admin');
    }

    public function testFliterMerge()
    {
        $this->post('/input/filter/merge', [
            'username'=> 'daud',
            'admin' => 'true',
            'password' => 'rahasia'
        ])->assertSeeText('daud')->assertSeeText('rahasia')
            ->assertSeeText('admin')->assertSeeText('false');
    }

}
