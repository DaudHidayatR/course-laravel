<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.author.first');
        $middlename =  config('contoh.author.middle');
        $lastName = config('contoh.author.last');

        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals('Daud', $firstName);
        self::assertEquals('Hidayat', $middlename);
        self::assertEquals('Ramadhan', $lastName);
        self::assertEquals('daud28ramadhan@gmail.com', $email);
        self::assertEquals('https://www.google.com', $web);

    }
}
