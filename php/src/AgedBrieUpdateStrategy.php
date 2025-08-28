<?php

declare(strict_types=1);

namespace GildedRose;

class AgedBrieUpdateStrategy extends AbstractBaseUpdate implements UpdateStrategyInterface
{
    public function update(): void
    {
        if ($this->isQualityLessThanMax()) {
            $this->qualityIncrement();
        }

        $this->sellInDecrement();

        if ($this->isSellInLessThanZero() && $this->isQualityLessThanMax()) {
            $this->qualityIncrement();
        }
    }
}