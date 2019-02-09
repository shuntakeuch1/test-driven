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

    public function run($result)
    {
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

    public function testFailed()
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
    private $result;
    public function setUp()
    {
        parent::setUp();
        $this->result = new TestResult();
    }

    public function testTemplateMethod()
    {
        $test = new WasRun('testMethod');
        $test->run($this->result);
        assert("setUp testMethod tearDown " == $test->log());
    }

    public function testResult()
    {
        $test = new WasRun("testMethod");
        $test->run($this->result);
        assert('1 run, 0 failed' === $this->result->summary());
    }

    public function testFailedResult()
    {
        $test = new WasRun("testBrokenMethod");
        $test->run($this->result);
        assert('1 run, 1 failed' === $this->result->summary());
    }

    public function testFailedResultFormatting()
    {
        $this->result->testStarted();
        $this->result->testFailed();
        assert('1 run, 1 failed' == $this->result->summary());
    }

    public function testSuite()
    {
        $suite = new TestSuite();
        $suite->add(new WasRun("testMethod"));
        $suite->add(new WasRun("testBrokenMethod"));
        $suite->run($this->result);
        assert("2 run, 1 failed" === $this->result->summary());
    }
}

class TestSuite
{
    private $tests;

    public function __construct()
    {
    }

    public function add($test)
    {
        $this->tests[] = $test;
    }

    public function run($result)
    {
        foreach ($this->tests as $test) {
            $test->run($result);
        }
    }
}

ini_set('assert.active', '1');
ini_set('assert.exception', '1');

$suite = new TestSuite();
$suite->add(new TestCaseTest('testTemplateMethod'));
$suite->add(new TestCaseTest('testResult'));
$suite->add(new TestCaseTest('testFailedResult'));
$suite->add(new TestCaseTest('testFailedResultFormatting'));
$suite->add(new TestCaseTest('testSuite'));

$result = new TestResult();
$suite->run($result);

echo $result->summary();
