<?php
use PHPUnit\Framework\TestCase;

class Calculator extends TestCase
{
    public function testCanSetSingleOperation()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([100, 2]);

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperation($addition);

        $this->assertCount(1, $calculator->getOperations());
    }

    public function testCanSetMultipleOperations()
    {
        $addition1 = new \App\Calculator\Addition;
        $addition1->setOperands([100, 2]);

        $addition2 = new \App\Calculator\Addition;
        $addition2->setOperands([2, 2]);

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition1, $addition2]);

        $this->assertCount(2, $calculator->getOperations());
    }

    public function testOperationsAreIgnoredIfNotInstanceOfOperationInterface()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([100, 2]);

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition, 'cats', 'dogs']);


        $this->assertCount(1, $calculator->getOperations());
    }

    public function testCanCalculateRresult()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([100, 2]);


        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperation($addition);

        $this->assertEquals(102, $calculator->calculate());
    }

    public function testCalculateMethodReturnsMultipleResults()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([100, 2]);

        $division = new \App\Calculator\Division;
        $division->setOperands([100, 2]);

        $calculator = new \App\Calculator\Calculator;
        $calculator->setOperations([$addition, $division]);

        $this->assertIsArray($calculator->calculate());
        $this->assertEquals(102, $calculator->calculate()[0]);
        $this->assertEquals(50, $calculator->calculate()[1]);
    }
}
