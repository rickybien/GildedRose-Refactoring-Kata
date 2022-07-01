<?php

namespace GildedRose;

class BackStage implements CalculateInterface
{
    use QualityTrait;

    public function calculateSellIn(int $sellIn): int
    {
        return $sellIn - self::BASE_SELL_IN;
    }

    public function calculateQuality(int $sellIn, int $quality): int
    {
        $plusQuality = self::BASE_QUALITY;
        if ($sellIn < 10) {
            $plusQuality += self::BASE_QUALITY;
        }
        if ($sellIn < 5) {
            $plusQuality += self::BASE_QUALITY;
        }
        if ($sellIn < 0) {
            $plusQuality = -$quality;
        }

        return $this->qualityLimit($quality + $plusQuality);
    }
}