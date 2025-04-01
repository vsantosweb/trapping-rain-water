<?php

namespace App\Repository\TrappingRainWater;

use Illuminate\Support\Facades\Log;

class TrappingRainWaterFileReader extends TrappingRainWaterCalculator implements TrappinRainWaterInterface
{
    private const SKIP_LINE = 2;

    private array $lines;


    public function read(string $filePath)
    {
        if (!file_exists($filePath)) {
            $msg = 'File does not exist';
            Log::error($msg);
            throw new \Exception($msg);
        }

        return file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    /**
     * Faz a leitura e o mapeamento das linhas obtida no arquivo 
     * @return void
     */
    public function process(mixed $filePath): array
    {
        $this->lines = $this->read($filePath);

        if (!$this->isValidFile()) {
            $msg = "O número de casos não pode ser maior do que a quantidade de listas válidas no arquivo.";
            Log::error($msg);
            throw new \Exception($msg);
        }

        $cases = $this->lines[0];

        $current = 1;
        $accummulated = [];

        for ($i = 1; $i <= $cases; $i++) {

            $arraySize = $this->lines[$current];
            $arrayModel = explode(' ', $this->lines[$current + 1]);
            $list = array_slice($arrayModel, 0, $arraySize);
            $current += self::SKIP_LINE;
            array_push($accummulated, $this->calculate($list));
        }

        return $accummulated;
    }

    /**
     * Valida se a quantidade de casos é igual a quantidade
     * de linhas renderizadas no arquivo
     * @return void
     */
    public function isValidFile(): bool
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
