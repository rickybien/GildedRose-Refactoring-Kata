<?php

declare(strict_types=1);

namespace GildedRose\DailyRefresh;

class NormalDailyRefresh implements DailyFreshInterface
{
    const QUALITY_DECREASE = 1;

    public function sellInDecrease(): int
    {
        return 1;
    }

    public function qualityDecrease(int $sellIn, int $quality): int
    {
        return self::QUALITY_DECREASE;
    }
}
