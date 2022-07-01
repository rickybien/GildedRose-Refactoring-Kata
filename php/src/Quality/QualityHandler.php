<?php

namespace GildedRose\Quality;

use GildedRose\Item;

abstract class QualityHandler
{
    protected bool $isChangeSellIn = true;
    protected const PER_QUALITY_DOWN_UNIT = 1;

    final public function __construct(protected Item $item) {}

    public function process(): void
    {
        $this->updateSellIn();
        $this->updateQuality();
    }

    final public function updateSellIn(): void
    {
        if ($this->isChangeSellIn) {
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