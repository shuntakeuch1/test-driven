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
        try {
            call_user_func([$this, $this->name]);
        } catch (\Exception $e) {
            $result->testFailed();
        }

        $this->tearDown();

        return $result;
    }
}

class TestResult
{

    private $runCount;
    private $errorCount;

    public function __construct()
    {
        $this->runCount = 0;
        $this->errorCount = 0;
    }

    public function testStarted()
    {
        $this->runCount++ ;
    }

    public  function testFailed()
    {
        $this->errorCount++ ;
    }

    public function summary()
    {
        return sprintf('%d run, %d failed', $this->runCount, $this->errorCount);
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
        $this->log .= "testMethod ";
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

    public function testFailedResultFormatting()
    {
        $result = new TestResult();
        $result->testStarted();
        $result->testFailed();
        assert('1 run, 1 failed' == $result->summary());
    }
}

ini_set('assert.active', '1');
ini_set('assert.exception', '1');

(new TestCaseTest('testTemplateMethod'))->run()->summary();
(new TestCaseTest('testResult'))->run()->summary();
(new TestCaseTest('testFailedResult'))->run()->summary();
(new TestCaseTest('testFailedResultFormatting'))->run()->summary();
