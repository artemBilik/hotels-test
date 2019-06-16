<?php


use Hotels\App\Hotel;
use Hotels\Commands\Order\Comparators\NameComparator;
use Hotels\Commands\Order\Comparators\StarComparator;
use PHPUnit\Framework\TestCase;

class OrderComparatorsTest extends TestCase
{

    public function testStar()
    {
        $comparator = new StarComparator();
        $plus = $comparator->compare(new Hotel('', '', 2), new Hotel('', '', 1));
        $zero = $comparator->compare(new Hotel('', '', 1), new Hotel('', '', 1));
        $minus = $comparator->compare(new Hotel('', '', 1), new Hotel('', '', 3));

        $this->assertGreaterThan(0, $plus, 'star comparator - wrong sign of the plus direction');
        $this->assertEquals(0, $zero, 'star comparator - wrong zero direction');
        $this->assertLessThan(0, $minus, 'star comparator - wrong minus direction');
    }

    public function testName()
    {
        $comparator = new NameComparator();
        $minus = $comparator->compare(new Hotel('aaa', '', 2), new Hotel('aab', '', 1));
        $zero = $comparator->compare(new Hotel('aaa', '', 1), new Hotel('aaa', '', 1));
        $plus = $comparator->compare(new Hotel('ccc', '', 1), new Hotel('ccb', '', 3));

        $this->assertGreaterThan(0, $plus, 'name comparator - wrong sign of the plus direction');
        $this->assertEquals(0, $zero, 'name comparator - wrong zero direction');
        $this->assertLessThan(0, $minus, 'name comparator - wrong minus direction');
    }

    public function testUrl()
    {
        $comparator = new NameComparator();
        $minus = $comparator->compare(new Hotel('aaa', 'aaa.com', 2), new Hotel('aab', 'aab.com', 1));
        $zero = $comparator->compare(new Hotel('aaa', 'aaa.com', 1), new Hotel('aaa', 'aaa.com', 1));
        $plus = $comparator->compare(new Hotel('ccc', 'ccc.com', 1), new Hotel('ccb', 'ccb.com', 3));

        $this->assertGreaterThan(0, $plus, 'url comparator - wrong sign of the plus direction');
        $this->assertEquals(0, $zero, 'url comparator - wrong zero direction');
        $this->assertLessThan(0, $minus, 'url comparator - wrong minus direction');
    }

}