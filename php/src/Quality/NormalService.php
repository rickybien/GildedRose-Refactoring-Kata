<?php

namespace GildedRose\Quality;

class NormalService extends QualityHandler
{
    public function updateQuality(): void
    {
        $item = $this->item;
        $qualityRate = self::PER_QUALITY_DOWN_UNIT;
        if ($item->sellIn < 0) {
            $qualityRate *= 2;
        }
        $item->quality = max($item->quality - $qualityRate, self::MIN_QUALITY);
    }
}