<?php

declare(strict_types=1);

namespace GildedRose;

class Conjured extends Normal
{
    public function calculate(): void
    {
        $this->minusQty(2);
        if ($this->checkIsExpired()) {
            $this->minusQty( 2);
        }
    }
}
