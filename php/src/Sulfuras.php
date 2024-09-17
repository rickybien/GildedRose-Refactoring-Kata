<?php

namespace GildedRose;

class Sulfuras implements CalculateInterface
{
    public function calculateSellIn(int $sellIn): int
    {
        return $sellIn;
    }

    public function calculateQuality(int $sellIn, int $quality): int
    {
        return $quality;
    }
}