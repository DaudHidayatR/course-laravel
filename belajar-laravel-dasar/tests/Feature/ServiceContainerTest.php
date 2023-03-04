<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
    $foo = $this->app->make(Foo::class);
    $foo2 = $this->app->make(Foo::class);

    self::assertEquals('Foo', $foo->foo());
    self::assertEquals('Foo', $foo2->foo());
    self::assertNotSame($foo,$foo2);
    }

    public function testBind()
    {
    $person = $this->app->bind(Person::class, function ($app){
        return new Person('daud','ramadhan');
    });
    $person = $this->app->make(Person::class);
    $person2 = $this->app->make(Person::class);

    self::assertEquals('daud', $person->firstname);
    self::assertEquals('daud', $person2->firstname);
    self::assertNotSame($person,$person2);
    }
    public function testSingleton()
    {
        $person = $this->app->singleton(Person::class, function ($app){
            return new Person('daud','ramadhan');
        });
        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('daud', $person->firstname);
        self::assertEquals('daud', $person2->firstname);
        self::assertSame($person,$person2);
    }
    public function testInstance()
    {
        $person = new Person("daud", "hidayat");
        $this->app->instance(Person::class, $person);

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('daud', $person->firstname);
        self::assertEquals('daud', $person2->firstname);
        self::assertSame($person,$person2);
    }
    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app){
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
//    $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

    $helloService = $this->app->singleton(HelloService::class, function($app){
     return new HelloServiceIndonesia();
    });
    $helloService = $this->app->make(HelloService::class);

    assertEquals("Halo daud", $helloService->hello("daud"));
    }

}
