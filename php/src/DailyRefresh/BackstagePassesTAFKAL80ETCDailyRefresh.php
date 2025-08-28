<?php

declare(strict_types=1);

namespace GildedRose\DailyRefresh;

class BackstagePassesTAFKAL80ETCDailyRefresh implements DailyFreshInterface
{
    public function sellInDecrease(): int
    {
        return 1;
    }

    public function qualityDecrease(int $sellIn, int $quality): int
    {
        if ($sellIn <= 0) {
            return $quality;
        }

        if ($sellIn <= 5) {
            return -3;
        }

        if ($sellIn <= 10) {
            return -2;
        }

        return -1;
    }
}
