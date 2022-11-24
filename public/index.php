<?php

require __DIR__ . '/../vendor/autoload.php';

function printBoard(Tris $tris) {
    passthru('clear');
    printf("\n");

    $positions = [];
    foreach([1,2,3,4,5,6,7,8,9] as $position) {
        $positions[$position] = $tris->getSimbolFromPosition($position);
    }

    printf("\n+---+---+---+");
    printf("\n| %s | %s | %s |", $positions[1], $positions[2], $positions[3]);
    printf("\n+---+---+---+");
    printf("\n| %s | %s | %s |", $positions[4], $positions[5], $positions[6]);
    printf("\n+---+---+---+");
    printf("\n| %s | %s | %s |", $positions[7], $positions[8], $positions[9]);
    printf("\n+---+---+---+");
    printf("\n");
}

$tris = new Tris();

printBoard($tris);

foreach([1,2,3,4,5,6,7,8,9] as $index => $move) {
    $tris->move((int) readline(sprintf("\n\n%s's turn: ", 'XO'[$index%2])));
    printBoard($tris);
    if ($tris->winningSerie() != []) {
        printf("\n\nWinner: %s\n\n", 'XO'[$index%2]);
        return;
    }
}

