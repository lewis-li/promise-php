<?php require(__DIR__.'/../src/Promise.php');

class PromiseTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
    }

    public function tearDown() {
    }

    public function testBasicResolve() {
        $phpunit = $this;
        $promise = new Promise(function($resolve) {
            $resolve('basic_resolve');
        });

        $promise->then(function($value) use ($phpunit) {
            $phpunit->assertEquals('basic_resolve', $value);
        });
    }

    public function testBasicReject() {
        $phpunit = $this;
        $promise = new Promise(function($resolve, $reject) {
            $reject('basic_reject');
        });

        $promise->then(function() {
            throw new Exception('Rejected promise should not trigger success callback!');
        }, function($value) use ($phpunit) {
            $phpunit->assertEquals('basic_reject', $value);
        });
    }
}
