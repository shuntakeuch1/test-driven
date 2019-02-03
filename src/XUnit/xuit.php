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
        $result = new TestResult();
        $result->testStarted();

        $this->setUp();
        call_user_func([$this, $this->name]);
        $this->tearDown();

        return $result;
    }
}

class TestResult
{

    private $runCount;

    public function __construct()
    {
        $this->runCount = 0;
    }

    public function testStarted()
    {
        $this->runCount++ ;
    }

    public function summary()
    {
        return sprintf('%d run, 0 failed', $this->runCount);
    }
}

class WasRun extends TestCase
{
    private $log;

    public function setUp()
    {
        $this->log = "setUp ";
    }

    public function testMethod()
    {
        $this->log = $this->log . "testMethod ";
    }

    public function testBrokenMethod()
    {
        throw new \Exception();
    }

    public function tearDown()
    {
        $this->log = $this->log . "tearDown ";
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

    public function testResult()
    {
        $test = new wasRun("testMethod");
        $result = $test->run();
        assert('1 run, 0 failed' === $result->summary());
    }

    public function testFailedResult()
    {
        $test = new WasRun("testBrokenMethod");
        $result = $test->run();
        assert('1 run, 1 failed' === $result->summary());
    }
}

ini_set('assert.active', '1');
ini_set('assert.exception', '1');

(new TestCaseTest('testTemplateMethod'))->run();
(new TestCaseTest('testResult'))->run();
// (new TestCaseTest('testFailedResult'))->run();
