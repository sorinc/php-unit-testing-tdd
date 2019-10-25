<?php
use PHPUnit\Framework\TestCase;

class DivisionTest extends TestCase
{
    public function testDividesGivenOperands()
    {
        $division = new \App\Calculator\Division;
        $division->setOperands([100, 2]);

        $this->assertEquals(50, $division->calculate());
    }

    public function testNoOperandsGivenThrowsExceptionWhenCalulated()
    {
        $this->expectException(\App\Calculator\Exceptions\NoOperandsException::class);

        $addition = new \App\Calculator\Division();
        // $addition->setOperands([5,10]);
        $addition->calculate();
    }

    public function testRemoveDivisionByZeroOperands()
    {
        $division = new \App\Calculator\Division;
        $division->setOperands([100, 0, 0, 5, 0]);
        
        $this->assertEquals(20, $division->calculate());
    }
}
