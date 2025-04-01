<?php

namespace App\Repository\TrappingRainWater;

use App\Repository\Interfaces\TrappingRainWaterRepositoryInterface;

class TrappingRainWaterRepository implements TrappingRainWaterRepositoryInterface
{
    /**
     * Fonte de dados para o cálculo.
     *
     * @var mixed
     */
    protected mixed $trappingRainWaterSource;

    /**
     * Tipo de fonte de dados padrão.
     *
     * @var string
     */
    protected const DEFAULT_DATA_SOURCE_TYPE = 'file';

    /**
     * Tipo de fonte de dados escolhida.
     *
     * @var string|null
     */
    protected string|null $dataSourceType = null;

    /**
     * Leitor de arquivos para processar os dados da chuva.
     *
     * @var TrappingRainWaterFileReader
     */
    protected TrappingRainWaterFileReader $trappingRainWaterFileReader;

    /**
     * Processador de dados para casos únicos.
     *
     * @var TrappingRainWaterUniqueCase
     */
    protected TrappingRainWaterUniqueCase $trappingRainWaterUniqueCase;

    public function __construct(
        TrappingRainWaterFileReader $trappingRainWaterFileReader,
        TrappingRainWaterUniqueCase $trappingRainWaterUniqueCase
    ) {
        $this->trappingRainWaterFileReader = $trappingRainWaterFileReader;
        $this->trappingRainWaterUniqueCase = $trappingRainWaterUniqueCase;
    }
    
    /**
     * Inicializa o algoritmo para calcular a chuva acumulada.
     * Pode receber diversas fontes de dados baseado em cada integração.
     *
     * @param mixed $dataSource Fonte de dados para o processamento.
     * @return mixed Pode retornar um array ou um inteiro
     */
    public function initialize(mixed $dataSource): array|int
    {
        $this->setup();

        return $this->trappingRainWaterSource->process($dataSource);
    }

    /**
     * Configura a fonte de dados correta para o processamento.
     *
     * @return void
     */
    private function setup(): void
    {
        if (is_null($this->dataSourceType)) {
            $dataSource = $this->register()[self::DEFAULT_DATA_SOURCE_TYPE];
        } else {
            $dataSource = $this->register()[$this->dataSourceType];
        }
        
        $this->trappingRainWaterSource = $dataSource;
    }

    /**
     * Define o tipo de fonte de dados que será usada.
     *
     * @param string $dataSourceType Tipo de fonte de dados.
     * @return void
     */
    public function setDataSource(string $dataSourceType): void
    {
        $this->dataSourceType = $dataSourceType;
    }

    /**
     * Registra as fontes de dados disponíveis.
     *
     * @return array Lista de fontes de dados mapeadas.
     */
    private function register(): array
    {
        return [
            'file' => $this->trappingRainWaterFileReader,
            'array' => $this->trappingRainWaterUniqueCase,
        ];
    }
}
