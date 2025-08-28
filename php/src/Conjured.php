<?php

namespace GildedRose;

readonly class Conjured extends BaseItem
{
    public function updateQuality(): void
    {
        $this->item->sellIn -= 1;

        if ($this->item->quality === 0) {
            return;
        }

        $this->item->quality -= 2;

        if ($this->item->sellIn <= 0) {
            $this->item->quality -= 2;
        }
    }
}
