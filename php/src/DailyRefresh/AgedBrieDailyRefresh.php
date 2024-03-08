<?php

declare(strict_types=1);

namespace GildedRose\DailyRefresh;

class AgedBrieDailyRefresh implements DailyFreshInterface
{
    public function sellInDecrease(): int
    {
        return 1;
    }

    public function qualityDecrease(int $sellIn, int $quality): int
    {
        return -1;
    }
}
