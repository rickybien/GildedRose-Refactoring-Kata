<?php

declare(strict_types=1);

namespace GildedRose;

class BackstagePasses extends Normal
{
    public function calculate(): void
    {
        $this->addQty(1);

        if ($this->item->sellIn < 10) {
            $this->addQty(1);
        }
        if ($this->item->sellIn < 5) {
            $this->addQty(1);
        }
        if ($this->checkIsExpired()) {
            $this->item->quality = 0;
        }
    }
}
