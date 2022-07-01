<?php

namespace GildedRose\Quality;

use GildedRose\Item;

class AgedBrieService extends QualityHandler
{
    public function updateQuality(): void
    {
        $item = $this->item;
        $item->sellIn = $item->sellIn -1;
        $qualityRate = 1;
        if ($item->sellIn < 0) {
            $qualityRate *= 2;
        }
        $item->quality = min($item->quality + $qualityRate, 50);
    }
}