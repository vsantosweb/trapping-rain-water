<?php

namespace App;

class TrapingRainWater
{
    private const SKIP_LINE = 2;

    private $lines;

    public function initialize(string $filePath)
    {

        if (!file_exists($filePath)) die('File does not');

        $this->lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $this->mappingFileCases();
    }

    private function mappingFileCases()
    {

        if(!$this->isValidCase()) die("O número de casos não pode ser maior do que a quantidade de listas válidas no arquivo.") ;

        $cases = $this->lines[0];

        $current = 1;

        for ($i = 1; $i <= $cases; $i++) {

            $arraySize = $this->lines[$current];

            $arrayModel = explode(' ', $this->lines[$current + 1]);

            $list = array_slice($arrayModel, 0, $arraySize);

            $current += self::SKIP_LINE;

            $this->calcAcummulated($list);

            $totalLists[] = $list;
        }
    }

    public function calcAcummulated(array $list)
    {
        $itemsCount = count($list);

        $left = array_fill(0, $itemsCount, 0);
        $right = array_fill(0, $itemsCount, 0);
        $accumulated = 0;

        $left[0] = $list[0];

        for ($i = 1; $i < $itemsCount; $i++) {
            $left[$i] = max($left[$i - 1], $list[$i]);
        }

        $right[$itemsCount - 1] = $list[$itemsCount - 1];


        for ($i = $itemsCount - 2; $i >= 0; $i--) {
            $right[$i] = max($right[$i + 1], $list[$i]);
        }

        $totalPerColumn = array_fill(0, $itemsCount, 0);

        for ($i = 0; $i < $itemsCount; $i++) {

            $totalPerColumn[$i] = max(0, min($left[$i], $right[$i]) - $list[$i]);
            $accumulated += max(0, min($left[$i], $right[$i]) - $list[$i]);
        }

        echo $accumulated. "\n";

        return $accumulated;
    }

    protected function isValidCase()
    {

        $totalCases = $this->lines[0];

        $lists = [];

        for ($i = 2; $i <= count($this->lines); $i += 2) {
            $lists[] =  $this->lines[$i];
        }

        if ($totalCases > count($lists)) return false;

        return true;
    }
}