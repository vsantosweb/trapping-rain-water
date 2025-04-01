<?php

namespace App\Repository\TrappingRainWater;

abstract class TrappingRainWaterCalculator
{
    /**
     * Calcula a quantidade de água acumulada com base na altura das colunas.
     *
     * @param array<int> $list Lista de alturas das colunas.
     * @return int Quantidade total de água acumulada.
     */
    public function calculate(array $list): int
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

        for ($i = 0; $i < $itemsCount; $i++) {
            $accumulated += max(0, min($left[$i], $right[$i]) - $list[$i]);
        }

        return $accumulated;
    }
}
