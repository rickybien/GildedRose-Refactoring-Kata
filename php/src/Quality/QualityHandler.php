<?php

namespace GildedRose\Quality;

use GildedRose\Item;

abstract class QualityHandler
{
    protected const IS_CHANGE_SELL_IN = true;
    protected const PER_QUALITY_DOWN_UNIT = 1;
    protected const MIN_QUALITY = 0;
    protected const MAX_QUALITY = 50;

    final public function __construct(protected Item $item) {}

    public function process(): void
    {
        $this->updateSellIn();
        $this->updateQuality();
    }

    final public function updateSellIn(): void
    {
        if (static::IS_CHANGE_SELL_IN) {
            --$this->item->sellIn;
        }
    }

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