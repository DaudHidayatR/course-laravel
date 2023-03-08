<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertSame;

class FooBarProviderTest extends TestCase
{
    public function testServiceProvider()
    {
       $foo = $this->app->make(Foo::class);
       $foo2 = $this->app->make(Foo::class);

       self::assertSame($foo, $foo2);
       $bar = $this->app->make(Bar::class);
       $bar2 = $this->app->make(Bar::class);

       self::assertSame($bar, $bar2);

       self::assertSame($bar->foo, $foo);
       self::assertSame($bar->foo, $foo2);
    }

    public function testPropertySingletons()
    {
    $helloService = $this->app->make(HelloService::class);
    $helloService2 = $this->app->make(HelloService::class);

    self::assertSame($helloService, $helloService2);
    self::assertEquals("Halo Daud", $helloService2->hello('Daud'));
    }
    public function testEmpty()
    {
        self::assertTrue(true);
    }
}
