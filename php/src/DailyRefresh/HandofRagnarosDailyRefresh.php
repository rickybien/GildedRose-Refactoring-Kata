<?php

declare(strict_types=1);

namespace GildedRose\DailyRefresh;

class HandofRagnarosDailyRefresh implements DailyFreshInterface
{
    public function sellInDecrease(): int
    {
        return 0;
    }

    public function qualityDecrease(int $sellIn, int $quality): int
    {
        return 0;
    }
}
