<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class UnitHelper extends \Codeception\Module
{

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
}
