<?php

namespace GildedRose;

class Conjured extends CalcInterface
{
    public function clac(): void
    {
        $this->item->sellIn = $this->item->sellIn - 1;

        $this->item->quality = $this->item->quality - 2;

        if ($this->item->quality < 0) {
            $this->item->quality = 0;
        }
    }
}