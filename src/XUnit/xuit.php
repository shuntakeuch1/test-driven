<?php

namespace XUnit;

class TestCase
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function run()
    {
        call_user_func([$this, $this->name]);
    }

}

class WasRun extends TestCase
{
    public $wasRun;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->wasRun = false;
    }

    public function testMethod()
    {
        $this->wasRun = 1;
    }
}

class TestCaseTest extends TestCase
{
    public function testRunning()
    {
        $test = new WasRun("testMethod");
        assert(!$test->wasRun);
        $test->run();
        assert($test->wasRun);
    }
}

ini_set('assert.active', '1');
ini_set('assert.exception', '1');
(new TestCaseTest('testRunning'))->run();
