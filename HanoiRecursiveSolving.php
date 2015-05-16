<?php

class HanoiRecursiveSolving
{

    /**
     * @var Hanoi
     */
    private $hanoi;

    public function __construct(Hanoi $hanoi)
    {
        $this->hanoi = $hanoi;
    }

    public function solve($numberOfDisk, $fromPeg, $toPeg)
    {
        if ($numberOfDisk <= 0) {
            return true;
        }
        $sparePeg = $this->hanoi->getSparePeg($fromPeg, $toPeg);
        $this->solve($numberOfDisk - 1, $fromPeg, $sparePeg);
        $this->hanoi->move($fromPeg, $toPeg);
        $this->solve($numberOfDisk - 1, $sparePeg, $toPeg);
    }
}