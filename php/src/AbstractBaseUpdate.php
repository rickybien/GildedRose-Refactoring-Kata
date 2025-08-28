<?php

declare(strict_types=1);

namespace GildedRose;

abstract class AbstractBaseUpdate
{
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function qualityIncrement(): void
    {
        ++$this->item->quality;
    }

    public function qualityDecrement(): void
    {
        --$this->item->quality;
    }

    public function qualityToZero(): void
    {
        $this->item->quality = 0;
    }

    public function sellInDecrement(): void
    {
        --$this->item->sellIn;
    }

    public function isQualityLessThanMax(): bool
    {
        return $this->item->quality < 50;
    }

    public function isQualityGreaterThanZero(): bool
    {
        return $this->item->quality > 0;
    }

    public function isSellInLessThan(int $num): bool
    {
        return $this->item->sellIn < $num;
    }

    public function isSellInLessThanZero(): bool
    {
        return $this->isSellInLessThan(0);
    }
}