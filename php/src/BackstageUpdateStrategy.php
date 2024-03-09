<?php

declare(strict_types=1);

namespace GildedRose;

class BackstageUpdateStrategy extends AbstractBaseUpdate implements UpdateStrategyInterface
{
    public function update(): void
    {
        if ($this->isQualityLessThanMax()) {
            $this->qualityIncrement();
            if ($this->isSellInLessThan(11) && $this->isQualityLessThanMax()) {
                $this->qualityIncrement();
            }
            if ($this->isSellInLessThan(6) && $this->isQualityLessThanMax()) {
                $this->qualityIncrement();
            }
        }

        $this->sellInDecrement();

        if ($this->isSellInLessThanZero()) {
            $this->qualityToZero();
        }
    }
}