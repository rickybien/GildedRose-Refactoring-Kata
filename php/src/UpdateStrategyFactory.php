<?php

declare(strict_types=1);

namespace GildedRose;

class UpdateStrategyFactory
{
    public static function create(Item $item): UpdateStrategyInterface
    {
        return match ($item->name) {
            'Aged Brie' => new AgedBrieUpdateStrategy($item),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstageUpdateStrategy($item),
            'Conjured' => new ConjuredUpdateStrategy($item),
            'Sulfuras, Hand of Ragnaros' => new SulfurasUpdateStrategy($item),
            default => new NormalUpdateStrategy($item),
        };
    }
}