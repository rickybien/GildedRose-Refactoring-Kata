<?php

declare(strict_types=1);

namespace GildedRose;

class BaseItem
{
    public function __construct()
    {
    }

    protected function increaseQuality(Item $item, int $multiple): void
    {
        $item->quality = min($item->quality + $multiple, 50);
    }

    protected function decreaseQuality(Item $item, int $multiple): void
    {
        $item->quality = max($item->quality - $multiple, 0);
    }

    protected function decreaseSellIn(Item $item): void
    {
        $item->sellIn--;
    }

    protected function isExpired(Item $item): bool
    {
        return $item->sellIn <= 0;
    }
}
