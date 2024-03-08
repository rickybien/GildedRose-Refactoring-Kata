<?php

declare(strict_types=1);

namespace GildedRose\DailyRefresh;

interface DailyFreshInterface
{
    public function sellInDecrease(): int;
    public function qualityDecrease($sellIn): int;
}
