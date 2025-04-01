<?php

/**
 * Preencher o maior valor à esquerda de cada posição
 * Preencher o maior valor à direita de cada posição
 * As bordas das paredes não contam, pois não tem como armazenar água
 * 
 */
//     [0] => 4----
//     [1] => 2--xx
//     [2] => 0xxxx
//     [3] => 3---x
//     [4] => 2--xx
//     [5] => 5-----



// print_r($totalLists);

// $list = [2, 3, 7, 1];

// print_r($list);
// (   


// )
// for($i = 0; $i < count($list); $i++){
//     echo $list[$i];
// }

function calcAcummulated(array $list)
{
    $itemsCount = count($list);


    /**
     * Preencher o maior valor à esquerda de cada posição
     * Preencher o maior valor à direita de cada posição
     */
    $left = array_fill(0, $itemsCount, 0);
    $right = array_fill(0, $itemsCount, 0);
    $accumulated = 0;
    // print_r([$left, $right]);

    $left[0] = $list[0];


    for ($i = 1; $i < $itemsCount; $i++) {
        $left[$i] = max($left[$i - 1], $list[$i]);
        //    echo $left[$i-1]."~".$list[$i]. "\n";
    }

    //Adiciona o primeiro item do lado direito á direita
    $right[$itemsCount - 1] = $list[$itemsCount - 1];
    // print_r([$left, $right]);


    //preenche $right com o maior valor comparando entre $right e $list em cada posição qual é o maior valor e define ele no index de $right
    for ($i = $itemsCount - 2; $i >= 0; $i--) {
        $right[$i] = max($right[$i + 1], $list[$i]); // se $right[$i] = 4 e $list[$i] = 5 entao max() considera 5
    }

    $totalPerColumn = array_fill(0, $itemsCount, 0);

    for ($i = 0; $i < $itemsCount; $i++) {

        // echo $left[$i]. '-'. $right[$i]. '-'. $list[$i]. "\n";
        // echo min(0, $left[$i], $right[$i]) - $list[$i];
        // echo max(0, min($left[$i], $right[$i]) - $list[$i]);
        $totalPerColumn[$i] = max(0, min($left[$i], $right[$i]) - $list[$i]);
        //Ele vai pegar o primeiro valor do indice da esquerda e da direita e retornar o valor mínimo (4), então
        // faz a subtração do primeiro indice da minha lista (4), então extrai o valor máximo da lista onde 4-4=0 logo não cabe
        //água naquela posição

        $accumulated += max(0, min($left[$i], $right[$i]) - $list[$i]);
    }

    // print_r([$left, $right, $list]);

    // print_r($totalPerColumn);

    echo $accumulated;

    // for ($i = 0; $i < $n; $i++) {
    //     $aguaAcumulada += max(0, min($leftMax[$i], $rightMax[$i]) - $arr[$i]);
    // }


    // for ($i = $n - 2; $i >= 0; $i--) {
    //     $rightMax[$i] = max($rightMax[$i + 1], $arr[$i]);
    // }

    // print_r(max(0, 3));
    // print_r($right);

    // print_r($left);
    // print_r(max([15, 5,5,6] ,$list));

}

$arrayModel = explode(' ', '5 4 3 2 1 2 3 4 5');

$lines = file('case.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


$cases = $lines[0];

const SKIP_LINE = 2;

$current = 1;

$totalLists = [];




$lists = [];


$currentLine = 2;


print_r(count($lists));

for ($i = 1; $i <= $cases; $i++) {

    $arraySize = $lines[$current];
    // $arrayModel = explode(' ', '5 4 3 2 1 2 3 4 5');
    $arrayModel = explode(' ', $lines[$current + 1]);

    $list = array_slice($arrayModel, 0, $arraySize);

    $current += SKIP_LINE;
    // calcAcummulated($list);
    $totalLists[] = $list;

    // echo $i."\n";

}

// print_r($list);