<?php

declare(strict_types=1);

namespace GildedRose;

class BackstageUpdateStrategy implements UpdateStrategyInterface
{
    public function update(Item $item): void
    {
        if ($item->quality < 50) {
            ++$item->quality;
            if ($item->sellIn < 11 && $item->quality < 50) {
                ++$item->quality;
            }
            if ($item->sellIn < 6 && $item->quality < 50) {
                ++$item->quality;
            }
        }

        --$item->sellIn;

        if ($item->sellIn < 0) {
            $item->quality = 0;
        }
    }
}