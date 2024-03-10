<?php

declare(strict_types=1);

namespace GildedRose;

class NormalItem extends BaseItem
{
    public function updateQuality(): void
    {
        $num = $this->isExpired($this->item) ? 2 : 1;

        $this->decreaseQuality($this->item, $num);
        $this->decreaseSellIn($this->item);
    }
}
