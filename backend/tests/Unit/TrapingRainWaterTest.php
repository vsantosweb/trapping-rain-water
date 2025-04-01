<?php

namespace Tests\Unit;

use App\Repository\Interfaces\TrappingRainWaterRepositoryInterface;
use App\Repository\TrappingRainWater\TrappingRainWaterFileReader;
use App\Repository\TrappingRainWater\TrappingRainWaterRepository;
use App\Repository\TrappingRainWater\TrappingRainWaterUniqueCase;
use Tests\TestCase;

class TrapingRainWaterTest extends TestCase
{

    protected TrappingRainWaterRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new TrappingRainWaterRepository(
            new TrappingRainWaterFileReader,
            new TrappingRainWaterUniqueCase
        );
    }
    
    public function test_should_recover_total_accumulated_water_single()
    {
        $this->repository->setDataSource(dataSourceType: 'array');
        $result = $this->repository->initialize(dataSource: [4, 2, 0, 3, 2, 5]);
        $this->assertEquals(9, $result);
    }

    public function test_should_recover_total_accumulated_water_file()
    {
        $path = public_path('cases/case.txt');
        $this->assertFileExists($path);
        
        $this->repository->setDataSource(dataSourceType: 'file');
        $result = $this->repository->initialize(dataSource: $path);
        $this->assertEquals([16, 214, 0, 0, 0, 0, 0], $result);
    }
}
