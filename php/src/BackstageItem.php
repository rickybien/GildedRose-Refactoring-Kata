<?php

declare(strict_types=1);

namespace GildedRose;

class BackstageItem extends BaseItem
{
    public function updateQuality(): void
    {
        if ($this->isExpired($this->item)) {
            $this->item->quality = 0;
        } else {
            $num = $this->calculateNum($this->item);
            $this->increaseQuality($this->item, $num);
        }

        $this->decreaseSellIn($this->item);
    }

    private function calculateNum(Item $item): int
    {
        $num = 1;
        if ($item->sellIn <= 5) {
            $num = 3;
        } elseif ($item->sellIn <= 10) {
            $num = 2;
        }
        return $num;
    }
}
