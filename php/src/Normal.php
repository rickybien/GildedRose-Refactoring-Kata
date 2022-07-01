<?php

namespace GildedRose;

class Normal extends CalcInterface
{
    public function clac(): void
    {
        $this->item->sellIn = $this->item->sellIn - 1;
        $this->item->quality = $this->item->quality - 1;

        if ($this->item->sellIn < 0) {
            $this->item->quality = $this->item->quality - 1;
        }

        if ($this->item->quality < 0) {
            $this->item->quality = 0;
        }
    }
}