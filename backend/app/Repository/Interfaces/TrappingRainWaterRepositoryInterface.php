<?php

namespace App\Repository\Interfaces;

interface TrappingRainWaterRepositoryInterface
{
    public function initialize(mixed $dataSource): array|int;

    public function setDataSource(string $dataSourceType): void;
}
