<?php

declare(strict_types=1);

namespace GildedRose;

class AgedBrieItem extends BaseItem
{
    public function updateQuality(): void
    {
        $num = $this->isExpired($this->item) ? 2 : 1;

        $this->increaseQuality($this->item, $num);
        $this->decreaseSellIn($this->item);
    }
}
