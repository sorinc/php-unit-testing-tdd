<?php

namespace App\Calculator;

use App\Calculator\Exceptions\NoOperandsException;

class Addition extends OperationAbstract implements OperationInterface
{
    public function calculate()
    {
        if (!isset($this->operands) || count($this->operands) === 0) {
            throw new NoOperandsException;
        }
        return array_sum($this->operands);
    }
}
