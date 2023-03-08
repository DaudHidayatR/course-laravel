<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use function Symfony\Component\String\s;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $fistName1 = config('contoh.author.first');
        $fistName2 = Config::get('contoh.author.first');

        self::assertEquals($fistName1, $fistName2);
        var_dump(Config::all());
    }
    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $fistName3 = $config->get('contoh.author.first');
        $fistName1 = config('contoh.author.first');
        $fistName2 = Config::get('contoh.author.first');

        self::assertEquals($fistName1, $fistName2);
        self::assertEquals($fistName1, $fistName3);
        var_dump(Config::all());
    }
    public function  testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('daud hidayat');
        $firstname = Config::get('contoh.author.first');

        self::assertEquals('daud hidayat', $firstname);
    }
}
