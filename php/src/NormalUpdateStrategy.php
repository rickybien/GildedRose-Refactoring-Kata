<?php

declare(strict_types=1);

namespace GildedRose;

class NormalUpdateStrategy extends AbstractBaseUpdate implements UpdateStrategyInterface
{
    public function update(): void
    {
        if ($this->isQualityGreaterThanZero()) {
            $this->qualityDecrement();
        }

        $this->sellInDecrement();

        if ($this->isSellInLessThanZero() && $this->isQualityGreaterThanZero()) {
            $this->qualityDecrement();
        }
    }
}