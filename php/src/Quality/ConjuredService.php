<?php

namespace GildedRose\Quality;

use GildedRose\Item;

class ConjuredService extends QualityHandler
{
    public function updateQuality(): void
    {
        $item = $this->item;
        $item->sellIn = $item->sellIn -1;
        $qualityRate = 1;
        $qualityRate *= 2;
        if ($item->sellIn < 0) {
            $qualityRate *= 2;
        }
        $item->quality = max($item->quality - $qualityRate, 0);
    }
}