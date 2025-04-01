<?php

namespace App\Repository\TrappingRainWater;

class TrappingRainWaterUniqueCase extends TrappingRainWaterCalculator implements TrappinRainWaterInterface
{
    public function process(mixed $list): int
    {
        return $this->calculate($list);
    }
}
