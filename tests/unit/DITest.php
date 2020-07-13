<?php


use PHPUnit\Framework\TestCase;
use Ragnarok\DI;

class DITest extends TestCase
{
    private $di;

    public function setUp(): void
    {
        $this->di = new DI();
    }

    public function testInject()
    {
        $object = new stdClass();

        $this->assertEquals($this->di->inject('object', $object), $object);
    }

    public function testInjectionWithMagicMethods()
    {
        $object = new stdClass();

        $this->assertEquals($this->di->object = $object, $object);
    }

    public function testGetInjectionWithMagicMethods()
    {
        $object = new stdClass();

        $this->di->inject('object', $object);
        $this->assertEquals($this->di->object, $object);
    }

    public function testGetEmptyInjectionWithMagicMethods()
    {
        $object = new stdClass();

        $this->di->inject('object1', $object);
        $this->assertNull($this->di->emptyObject);
    }

    public function testGetInjectionWithGetMethod()
    {
        $object = new stdClass();

        $this->di->inject('object', $object);
        $this->assertEquals($this->di->get('object'), $object);
    }

    public function testGetEmptyInjectionWithGetMethod()
    {
        $object = new stdClass();

        $this->di->inject('object', $object);
        $this->assertNull($this->di->get('emptyObject'));
    }

//    public function testInjectDuplicate()
//    {
//
//    }
}