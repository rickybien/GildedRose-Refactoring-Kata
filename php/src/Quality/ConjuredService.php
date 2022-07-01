<?php

namespace GildedRose\Quality;

class ConjuredService extends QualityHandler
{
    public function updateQuality(): void
    {
        $item = $this->item;
        $qualityRate = self::PER_QUALITY_DOWN_UNIT * 2;
        if ($item->sellIn < 0) {
            $qualityRate *= 2;
        }
        $item->quality = max($item->quality - $qualityRate, 0);
    }
}