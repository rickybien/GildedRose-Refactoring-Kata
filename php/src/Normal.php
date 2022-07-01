<?php

declare(strict_types=1);

namespace GildedRose;

class Normal
{
    public const QTY_MAX = 50;
    public const QTY_MIN = 0;

    public function __construct(public Item $item) {
        $this->minusSellIn();
    }

    public function minusSellIn(): void
    {
        --$this->item->sellIn;
    }

    public function addQty(int $add): void
    {
        $this->item->quality += $add;
        if ($this->item->quality > self::QTY_MAX) {
            $this->item->quality = self::QTY_MAX;
        }
        if ($this->item->quality < self::QTY_MIN) {
            $this->item->quality = self::QTY_MIN;
        }
    }
}
