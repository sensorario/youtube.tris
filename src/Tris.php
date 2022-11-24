<?php

class Tris
{
    private array $moves = [];

    private array $winningSeries = [
        // horizontal
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9],
        // vertical
        [1, 4, 7],
        [2, 5, 8],
        [3, 6, 9],
        // diagonal
        [1, 5, 9],
        [3, 5, 7],
    ];

    public function move(int $position): void
    {
        $this->moves[] = 'XO'[count($this->moves)%2] . $position;
    }

    public function lastMove(): string
    {
        return end($this->moves);
    }

    public function moves(?string $symbol = null): array
    {
        if ($symbol == null) {
            return $this->moves;
        }

        $moves = array_filter(
            $this->moves,
            function ($index, $value) use ($symbol) {
                return $index[0] == $symbol;
            },
            ARRAY_FILTER_USE_BOTH
        );

        sort($moves);

        return $moves;
    }

    public function positions(?string $symbol = null): array
    {
        if ($symbol == null) {
            $moves = [];
            foreach($this->moves as $move) {
                $moves[] = (int) $move[1];
            }
            return $moves;
        }

        $map = array_map(
            function($move) use ($symbol) {
                return (int) $move[1];
            },
            $this->moves($symbol)
        );

        return $map;
    }

    public function winningSerie(): array
    {
        foreach($this->winningSeries as $serie) {
            if (
                array_diff($serie, $this->positions('X')) == []
                || array_diff($serie, $this->positions('O')) == []
            ) {
                return $serie;
            }
        }

        return [];
    }

    public function getSimbolFromPosition(int $position)
    {
        foreach($this->moves() as $move) {
            if ($move[1] == $position) {
                return $move[0];
            }
        }

        return $position;
    }
}
