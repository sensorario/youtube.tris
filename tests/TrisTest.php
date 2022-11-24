<?php

class TrisTest extends PHPUnit\Framework\TestCase
{
    /** @test */
    public function shouldAssignRightSymbolOnEachMove()
    {
        $tris = new Tris();
        $tris->move(1);
        $this->assertEquals('X1', $tris->lastMove());
        $tris->move(2);
        $this->assertEquals('O2', $tris->lastMove());
    }

    /** @test */
    public function shouldRememberEachMoves()
    {
        $tris = new Tris();
        $tris->move(1);
        $tris->move(2);
        $this->assertEquals(['X1', 'O2'], $tris->moves());
    }

    /** @test */
    public function shouldRememberPlayerMoves()
    {
        $tris = new Tris();
        $tris->move(1);
        $tris->move(2);
        $tris->move(5);
        $tris->move(4);
        $tris->move(3);
        $this->assertEquals(['X1', 'X3', 'X5'], $tris->moves('X'));
        $this->assertEquals(['O2', 'O4'], $tris->moves('O'));
        $this->assertEquals([1, 2, 5, 4, 3], $tris->positions());
        $this->assertEquals([1, 3, 5], $tris->positions('X'));
    }

    /** @test */
    public function shouldDetectWinningSeries()
    {
        $tris = new Tris();
        $tris->move(3);
        $tris->move(2);
        $tris->move(7);
        $tris->move(4);
        $tris->move(5);
        $this->assertEquals([3, 5, 7], $tris->winningSerie());
    }

    /** @test */
    public function shouldProvideSymbolFromAGivenPosition()
    {
        $tris = new Tris();
        $tris->move(3);
        $tris->move(2);
        $tris->move(7);
        $this->assertEquals('X', $tris->getSimbolFromPosition(7));
    }
}
