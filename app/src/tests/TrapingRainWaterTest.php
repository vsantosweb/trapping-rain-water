<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\TrapingRainWater;

class TrapingRainWaterTest extends TestCase
{
    public function testShouldRecoverTotalAccumulatedWater()
    {
        $trapingRainWater = new TrapingRainWater();

        $this->assertEquals(6, $trapingRainWater->calcAcummulated([0, 1, 0, 2, 1, 0, 1, 3, 2, 1, 2, 1]));
    }
}
