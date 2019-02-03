<?php

namespace XUnit;

class TestCase
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setUp()
    {
    }

    public function tearDown()
    {
    }

    public function run()
    {
        $this->setUp();
        call_user_func([$this, $this->name]);
        $this->tearDown();
    }
}

class WasRun extends TestCase
{
    private $wasRun;
    private $log;

    public function setUp()
    {
        $this->wasRun = false;
        $this->log = "setUp ";
    }

    public function testMethod()
    {
        $this->wasRun = 1;
        $this->log = $this->log . "testMethod ";
    }

    public function tearDown()
    {
        $this->log = $this->log . "tearDown ";
    }

    public function wasRun()
    {
        return $this->wasRun;
    }

    public function log()
    {
        return $this->log;
    }
}

class TestCaseTest extends TestCase
{
    public function testTemplateMethod()
    {
        $test = new WasRun('testMethod');
        $test->run();
        assert("setUp testMethod tearDown " == $test->log());
    }
}

ini_set('assert.active', '1');
ini_set('assert.exception', '1');
(new TestCaseTest('testTemplateMethod'))->run();
