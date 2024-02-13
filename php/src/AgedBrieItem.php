<?php

namespace GildedRose;

readonly class AgedBrieItem
{
    public function __construct(private Item $item)
    {
    }

    public function updateQuality(): void
    {
        $this->item->sellIn -= 1;

        if ($this->item->quality >= 50) {
            return;
        }

        $this->item->quality += 1;

        if ($this->item->sellIn <= 0 && $this->item->quality < 50) {
            $this->item->quality += 1;
        }
    }
}
