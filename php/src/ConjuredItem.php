<?php

declare(strict_types=1);

namespace GildedRose;

class ConjuredItem extends BaseItem
{
    public function updateQuality(): void
    {
        $num = $this->isExpired($this->item) ? 4 : 2;

        $this->decreaseQuality($this->item, $num);
        $this->decreaseSellIn($this->item);
    }
}
