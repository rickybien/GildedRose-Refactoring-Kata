<?php

declare(strict_types=1);

namespace GildedRose;

class General extends Normal
{
    public function calculate(): void
    {
        $this->minusQty(1);
        if ($this->checkIsExpired()) {
            $this->minusQty( 1);
        }
    }
}
