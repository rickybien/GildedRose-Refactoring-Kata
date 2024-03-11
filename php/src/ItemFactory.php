<?php

declare(strict_types=1);

namespace GildedRose;

class ItemFactory
{
    public static function getItemClass(string $name): ItemInterface
    {
        return match ($name) {
            'normal' => new itemNormal(),
            'Aged Brie' => new itemAgedBrie(),
            'Sulfuras, Hand of Ragnaros' => new itemSulfuras(),
            'Backstage passes to a TAFKAL80ETC concert' => new itemBackstagePasses(),
            'Conjured' => new itemConjured(),
        };
    }
}
