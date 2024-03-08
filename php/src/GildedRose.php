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
            $computer = $this->transfer($item);
            $computer->updateQuality();
        }
    }

    private function transfer(Item $item): BaseItem
    {
        return match ($item->name) {
            'normal' => new NormalItem($item),
            'Aged Brie' => new AgedBrieItem($item),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstageItem($item),
            'Conjured' => new Conjured($item),
            default => new BaseItem($item),
        };
    }
}
