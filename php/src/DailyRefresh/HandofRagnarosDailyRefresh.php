<?php

declare(strict_types=1);

namespace GildedRose\DailyRefresh;

class HandofRagnarosDailyRefresh implements DailyFreshInterface
{
    public function sellInDecrease(): int
    {
        return 0;
    }

    public function qualityDecrease($sellIn): int
    {
        return 0;
    }
}
