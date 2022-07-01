<?php

namespace GildedRose\Quality;

class BackstagePassesService extends QualityHandler
{
    public function updateQuality(): void
    {
        $item = $this->item;
        $item->sellIn = $item->sellIn -1;
        $qualityRate = 1;
        if ($item->sellIn < 0) {
            $item->quality = 0;
            return;
        }
        if ($item->sellIn < 10) {
            $qualityRate = 2;
            if ($item->sellIn < 5) {
                $qualityRate = 3;
            }
        }
        $item->quality = min($item->quality + $qualityRate, 50);
    }
}