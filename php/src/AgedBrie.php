<?php

declare(strict_types=1);

namespace GildedRose;

class AgedBrie extends Normal
{
    public function calculate(): void
    {
        if ($this->checkIsExpired()) {
            $this->addQty(2);
        }else {
            $this->addQty(1);
        }
    }
}
