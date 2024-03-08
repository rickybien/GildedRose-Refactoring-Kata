<?php

namespace GildedRose;

abstract class CalcInterface
{
    public function __construct(protected $item)
    {
    }

    /**
     * 計算
     * @return mixed
     */
    abstract public function clac(): void;
}