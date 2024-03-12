<?php

namespace GildedRose;

class Normal implements Product
{
    public function updateQuality(object $item): void
    {
        if ($item->quality > 0) {
            $item->quality = $item->quality - 1;
        }

        $item->sellIn = $item->sellIn - 1;

        if ($item->sellIn < 0) {
            if ($item->quality > 0) {
                $item->quality = $item->quality - 1;
            }
        }
    }
}