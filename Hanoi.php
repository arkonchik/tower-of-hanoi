<?php

class Hanoi
{
    const PEG_A = 1;
    const PEG_B = 2;
    const PEG_C = 3;

    /**
     * @var int
     */
    private $countMove = 0;

    /**
     * @var Peg[]
     */
    private $allPegs = array();

    private $numberOfDisks;

    /**
     * @var int
     */
    private $startPosition;

    private $debug = false;

    private $debugInfo = array();

    public function __construct($numberOfDisks, $startPegNumber)
    {
        $this->numberOfDisks = $numberOfDisks;
        $this->startPosition = $startPegNumber;

        $this->attachPegsAndDisks($numberOfDisks, $startPegNumber);

    }

    /**
     * @param $numberOfDisks
     * @param $startPegNumber
     */
    public function attachPegsAndDisks($numberOfDisks, $startPegNumber)
    {
        for ($pegNumber = self::PEG_A; $pegNumber <= self::PEG_C; $pegNumber++) {
            $peg = new Peg($pegNumber);
            if ($pegNumber == $startPegNumber) {
                for ($diskSize = $numberOfDisks; $diskSize >= 1; $diskSize--) {
                    $disk = new Disk($diskSize);
                    $peg->addDisk($disk);
                }
            }
            $this->allPegs[$pegNumber] = $peg;
        }
    }

    public function getSparePeg($pegNumber1, $pegNumber2)
    {
        $ad = array_diff_key($this->allPegs, array($pegNumber1 => $pegNumber1, $pegNumber2 => $pegNumber2));
        return key($ad);
    }

    public function move($fromPeg, $toPeg)
    {
        $disk = $this->allPegs[$fromPeg]->getDisk();
        $this->allPegs[$toPeg]->addDisk($disk);

        if ($this->debug) {
            ++$this->countMove;
            $this->addDebugInfo("move disk {$disk->size()} from peg $fromPeg to $toPeg");
        }
    }

    /**
     * @return int
     */
    public function getCountMove()
    {
        return $this->countMove;
    }

    /**
     * @return mixed
     */
    public function getNumberOfDisks()
    {
        return $this->numberOfDisks;
    }

    /**
     * @return int
     */
    public function getStartPosition()
    {
        return $this->startPosition;
    }

    /**
     * @param boolean $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * @param array $message
     */
    public function addDebugInfo($message)
    {
        $this->debugInfo[] = $message;
    }

    /**
     * @return array
     */
    public function getDebugInfo()
    {
        return $this->debugInfo;
    }

}

class Peg
{

    private $pegNumber;

    /**
     * @var Disk[]
     */
    private $disks = array();

    public function __construct($pegNumber)
    {
        $this->pegNumber = $pegNumber;
    }

    public function addDisk(Disk $disk)
    {
        /**
         * @var $firstDisk Disk
         */
        $firstDisk = reset($this->disks);
        if (empty($firstDisk) || $firstDisk->size() > $disk->size()) {
            array_unshift($this->disks, $disk);
        } else {
            throw new LogicException('asdf');
        }
    }

    /**
     * @return Disk
     */
    public function getDisk()
    {
        return array_shift($this->disks);
    }
}

class Disk
{

    private $size;

    public function __construct($size)
    {
        if (!is_numeric($size)) {
            throw new InvalidArgumentException('wrong size');
        }
        $this->size = $size;
    }


    public function size()
    {
        return $this->size;
    }

}
