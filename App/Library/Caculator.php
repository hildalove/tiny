<?php

namespace App\Libraby;


class Caculator
{
    public function add($x, $y)
    {
        if (!is_numeric($x) || !is_numeric($y)) {
            throw new \InvalidArgumentException;
        }
        return $x + $y;
    }
}