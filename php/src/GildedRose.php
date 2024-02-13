<?php

declare(strict_types=1);

namespace GildedRose;

final readonly class GildedRose
{
    public function __construct(private array $items)
    {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item->name === 'normal') {
                $normalItem = new NormalItem($item);
                $normalItem->updateQuality();

                return;
            }
            if ($item->name === 'Aged Brie') {
                $agedBrieItem = new AgedBrieItem($item);
                $agedBrieItem->updateQuality();

                return;
            }
            if ($item->name === 'Sulfuras, Hand of Ragnaros') {
                $sulfurasItem = new SulfurasItem($item);
                $sulfurasItem->updateQuality();

                return;
            }
            if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
                $backstageItem = new BackstageItem($item);
                $backstageItem->updateQuality();

                return;
            }
        }
    }
}
