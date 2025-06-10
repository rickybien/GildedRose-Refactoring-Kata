<?php

namespace GildedRose;

class AgedBrie implements Product
{
    public function updateQuality(object $item): void
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
        }

        $item->sellIn = $item->sellIn - 1;

        if ($item->sellIn < 0) {
            if ($item->quality < 50) {
                $item->quality = $item->quality + 1;
            }
        }
    }
}