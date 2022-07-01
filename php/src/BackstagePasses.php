<?php

declare(strict_types=1);

namespace GildedRose;

class BackstagePasses extends Normal
{
    public function calculate(): void
    {
        --$this->item->sellIn;

        $this->item->quality = $this->addQty(1);

        if ($this->item->sellIn < 10) {
            $this->item->quality = $this->addQty(1);
        }
        if ($this->item->sellIn < 5) {
            $this->item->quality = $this->addQty(1);
        }
        if ($this->item->sellIn < 0) {
            $this->item->quality = 0;
        }
    }
}
