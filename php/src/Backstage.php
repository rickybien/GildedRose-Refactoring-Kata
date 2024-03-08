<?php

namespace GildedRose;

class Backstage extends CalcInterface
{
    public function clac(): void
    {
        $this->item->sellIn = $this->item->sellIn - 1;

        if ($this->item->sellIn < 0) {
            $this->item->quality = 0;
            return;
        }

        $this->item->quality = $this->item->quality + 1;

        if ($this->item->sellIn > 0 && $this->item->sellIn <= 5) {
            $this->item->quality = $this->item->quality + 2;
        }

        if ($this->item->sellIn > 5 && $this->item->sellIn < 10) {
            $this->item->quality = $this->item->quality + 1;
        }

        if ($this->item->quality >= 50) {
            $this->item->quality = 50;
        }
    }
}