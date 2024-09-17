<?php

namespace GildedRose;

class AgedBrie implements CalculateInterface
{
    use QualityTrait;

    public function calculateSellIn(int $sellIn): int
    {
        return $sellIn - self::BASE_SELL_IN;
    }

    public function calculateQuality(int $sellIn, int $quality): int
    {
        return $this->qualityLimit($quality + $this->getModifyQuality($sellIn));
    }
}