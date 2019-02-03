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

    public function run()
    {
        $this->setUp();
        call_user_func([$this, $this->name]);
    }
}

class WasRun extends TestCase
{
    private $wasRun;
    private $wasSetUp;

    public function setUp()
    {
        $this->wasRun = false;
        $this->wasSetUp = 1;
    }

    public function testMethod()
    {
        $this->wasRun = 1;
    }

    public function wasRun()
    {
        return $this->wasRun;
    }

    public function wasSetUp()
    {
        return $this->wasSetUp;
    }
}

class TestCaseTest extends TestCase
{
    private $test;

    public function setUp()
    {
        $this->test = new WasRun('testMethod');
    }

    public function testRunning()
    {
        $this->test->run();
        assert($this->test->wasRun());
    }

    public function testSetUp()
    {
        $this->test->run();
        assert($this->test->wasSetUp());
    }
}

ini_set('assert.active', '1');
ini_set('assert.exception', '1');
(new TestCaseTest('testRunning'))->run();
(new TestCaseTest('testSetUp'))->run();
