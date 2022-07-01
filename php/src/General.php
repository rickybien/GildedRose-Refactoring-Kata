<?php

declare(strict_types=1);

namespace GildedRose;

class General extends Normal
{
    public function calculate(): void
    {
        --$this->item->sellIn;
        $this->item->quality = $this->addQty(-1);
        if ($this->item->sellIn < 0) {
            $this->item->quality = $this->addQty( -1);
        }
    }
}
