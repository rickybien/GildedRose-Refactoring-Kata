<?php

namespace GildedRose;

readonly class NormalItem
{
    public function __construct(private Item $item)
    {
    }

    public function updateQuality(): void
    {
        if ($this->item->quality > 0) {
            if ($this->item->sellIn > 0) {
                $this->item->quality -= 1;
            }
            if ($this->item->sellIn <= 0) {
                $this->item->quality -= 2;
            }
        }

        $this->item->sellIn -= 1;
    }
}
