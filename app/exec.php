<?php

require_once 'vendor/autoload.php';

use App\TrapingRainWater;

$trapingRainWater = new TrapingRainWater();

$trapingRainWater->initialize('src/case.txt');
