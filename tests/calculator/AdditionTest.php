<?php
use PHPUnit\Framework\TestCase;

class AdditionTest extends TestCase
{
    public function testAddsUpOpenrands()
    {
        $addition = new \App\Calculator\Addition();
        $addition->setOperands([5,10]);

        $this->assertEquals(15, $addition->calculate());
    }

    public function testNoOperandsGivenThrowsExceptionWhenCalulated()
    {
        $this->expectException(\App\Calculator\Exceptions\NoOperandsException::class);

        $addition = new \App\Calculator\Addition();
        // $addition->setOperands([5,10]);
        $addition->calculate();
    }
}
