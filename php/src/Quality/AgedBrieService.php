<?php

namespace GildedRose\Quality;

class AgedBrieService extends QualityHandler
{
    public function updateQuality(): void
    {
        $item = $this->item;
        $qualityRate = self::PER_QUALITY_DOWN_UNIT;
        if ($item->sellIn < 0) {
            $qualityRate *= 2;
        }
        $item->quality = min($item->quality + $qualityRate, self::MAX_QUALITY);
    }
}