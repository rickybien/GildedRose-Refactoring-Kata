<?php

declare(strict_types=1);

namespace GildedRose;

class Normal
{
    public const QTY_MAX = 50;
    public const QTY_MIN = 0;

    public function __construct(public Item $item) {

    }

    public function addQty(int $add): int
    {
        $result = $this->item->quality + $add;
        if ($result > self::QTY_MAX) {
            return self::QTY_MAX;
        }
        if ($result < self::QTY_MIN) {
            return self::QTY_MIN;
        }
        return $result;
    }
}
