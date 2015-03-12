<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class UnitHelper extends \Codeception\Module
{

    /**
     * Assert that a countable item matches an expected amount.
     *
     * @param $countable
     *   The countable item that should be compared.
     * @param $expected
     *   The expected count() result.
     * @param string $message
     *   The message that should be shown in the event of a failure.
     * @return mixed
     */
    public function assertCount($countable, $expected, $message = '')
    {
        if (!is_int($expected)) {
            $this->fail('Can\'t count against ' . $expected);
        }

        if (!$countable instanceof \Countable && !$countable instanceof \Traversable && !is_array($countable)) {
            $this->fail($countable. ' is not countable.');
        }

        return $this->assertEquals(count($countable), $expected, $message);
    }

    /**
     * Assert that a Codeception assertion should fail.
     *
     * @param callable $function
     *   A closure containing the code that should fail.
     *
     * @return void
     */
    public function shouldFail($function)
    {

        $result = false;

        $assertionFailed = $this->seeExceptionThrown(
            'PHPUnit_Framework_AssertionFailedError',
            $function
        );

        $expectationFailed = $this->seeExceptionThrown(
            'PHPUnit_Framework_ExpectationFailedException',
            $function
        );

        if ($assertionFailed || $expectationFailed) {
            $result = true;
        }

        $this->assertTrue($result);
    }

    /**
     * Check that an exception is thrown.
     *
     * @param $exception
     *   The class name name of the exception you are expecting (i.e. PHPUnit_Framework_AssertionFailedError)
     * @param $function
     *   A closure containing the code that should throw the expected exception.
     * @return bool
     *   True if the exception was thrown, false if not.
     */
    public function seeExceptionThrown($exception, $function)
    {
        try {
            $function();
            return false;
        } catch (\Exception $e) {
            if (get_class($e) === $exception) {
                return true;
            }
            return false;
        }
    }
}
