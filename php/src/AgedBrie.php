<?php

declare(strict_types=1);

namespace GildedRose;

class AgedBrie extends Normal
{
    public function calculate(): void
    {
        if ($this->item->sellIn < 0) {
            $this->addQty(2);
        }else {
            $this->addQty(1);
        }
    }
}
