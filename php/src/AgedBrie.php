<?php

declare(strict_types=1);

namespace GildedRose;

class AgedBrie extends Normal
{
    public function calculate(): void
    {
        --$this->item->sellIn;
        if ($this->item->sellIn < 0) {
            $this->item->quality = $this->addQty(2);
        }else {
            $this->item->quality = $this->addQty(1,);
        }
    }
}
