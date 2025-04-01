<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\TrappingRainWaterRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrappingRainWaterController extends Controller
{
    protected TrappingRainWaterRepositoryInterface $repository;

    public function __construct(TrappingRainWaterRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Calcula a quantidade de água 
     * acumulada baseada em um arquivo modelo
     */
    public function calculateFromFile(): JsonResponse
    {
        try {

            $this->repository->setDataSource(dataSourceType: 'file');
            $data = $this->repository->initialize(dataSource: public_path('cases/case.txt'));

            return response()->json([
                'success' => true,
                'message' => '',
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
                'data' => null,
            ], 200);
        }
    }

    /**
     * Calcula a quantidade de água acumuldada 
     * baseado em um parametro singular.
     */
    public function calculateFromSingleList(Request $request): JsonResponse
    {
        
        try {

            $this->repository->setDataSource(dataSourceType: 'array');
            $data = $this->repository->initialize(dataSource: [4, 2, 0, 3, 2, 5]);

            return response()->json([
                'success' => true,
                'message' => '',
                'data' => $data,
            ], 200);
            
        } catch (\Exception $e) {

            return response()->json([
                'success' => true,
                'message' => $e->getMessage(),
                'data' => null,
            ], 200);
        }
        
    }
}
