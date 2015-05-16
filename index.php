<?php
require_once __DIR__.'/Hanoi.php';
require_once __DIR__.'/HanoiRecursiveSolving.php';

$time = microtime(true);
$hanoi = new Hanoi(4, Hanoi::PEG_A);
$hanoi->setDebug(true);
$hanoiSolving = new HanoiRecursiveSolving($hanoi);
$hanoiSolving->solve($hanoi->getNumberOfDisks(), $hanoi->getStartPosition(), Hanoi::PEG_C);

echo 'count of move - '.$hanoi->getCountMove()."<br>";
echo "time execute - ".(microtime(true) - $time)."<br>";

foreach ($hanoi->getDebugInfo() as $infoMessage) {
    echo "$infoMessage <br>";
}
