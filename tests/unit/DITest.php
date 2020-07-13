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

    public function testGetAllInjections()
    {
        $object = new stdClass();
        $object2 = new stdClass();

        $this->di->inject('object', $object);
        $this->di->inject('object2', $object2);

        $this->assertCount(2, $this->di->all());
        $this->assertArrayHasKey('object', $this->di->all());
        $this->assertArrayHasKey('object2', $this->di->all());
    }

    public function testGetAllEmptyInjections()
    {
        $this->assertNull($this->di->all());
    }

    public function testHasInjection()
    {
        $object = new stdClass();

        $this->di->inject('object', $object);
        $this->assertTrue($this->di->has('object'));
    }

    public function testHasEmptyInjection()
    {
        $this->assertFalse($this->di->has('object'));
    }
}