<?php

declare(strict_types=1);

namespace GildedRose\DailyRefresh;

class DailyRefreshInfoDto
{
    public function __construct(public int $sellIn, public int $quality)
    {
    }
}
