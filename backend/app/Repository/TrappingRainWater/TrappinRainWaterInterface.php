<?php

namespace App\Repository\TrappingRainWater;

interface TrappinRainWaterInterface
{
    public function process(mixed $dataSource): array|int;
}