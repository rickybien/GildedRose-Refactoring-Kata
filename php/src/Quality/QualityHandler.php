<?php

namespace GildedRose\Quality;

use GildedRose\Item;

abstract class QualityHandler
{
    final public function __construct(protected Item $item) {}

    abstract public function updateQuality(): void;

    final public static function getInstance(Item $item): self
    {
        return match ($item->name) {
            'Aged Brie' => new AgedBrieService($item),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePassesService($item),
            'Sulfuras, Hand of Ragnaros' => new SulfurasService($item),
            'Conjured' => new ConjuredService($item),
            default => new NormalService($item),
        };
    }
}