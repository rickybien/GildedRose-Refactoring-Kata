<?php

declare(strict_types=1);

namespace GildedRose;

class UpdateStrategyFactory
{
    public static function create(string $name): UpdateStrategyInterface
    {
        return match ($name) {
            'Aged Brie' => new AgedBrieUpdateStrategy(),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstageUpdateStrategy(),
            'Conjured' => new ConjuredUpdateStrategy(),
            'Sulfuras, Hand of Ragnaros' => new SulfurasUpdateStrategy(),
            default => new NormalUpdateStrategy(),
        };
    }
}