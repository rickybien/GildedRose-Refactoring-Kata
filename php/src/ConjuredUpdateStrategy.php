<?php

declare(strict_types=1);

namespace GildedRose;

class ConjuredUpdateStrategy implements UpdateStrategyInterface
{
    public function update(Item $item): void
    {
        if ($item->quality > 0) {
            --$item->quality;
            if ($item->quality > 0) {
                --$item->quality;
            }
        }

        --$item->sellIn;

        if ($item->sellIn < 0 && $item->quality > 0) {
            --$item->quality;
            if ($item->quality > 0) {
                --$item->quality;
            }
        }
    }
}