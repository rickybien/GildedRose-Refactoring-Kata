<?php

declare(strict_types=1);

namespace GildedRose\DailyRefresh;

class DailyFreshFactory
{
    public static function createDailyFresh($name): DailyFreshInterface
    {
        return match ($name) {
            'Aged Brie' => new AgedBrieDailyRefresh(),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePassesTAFKAL80ETCDailyRefresh(),
            'Sulfuras, Hand of Ragnaros' => new HandofRagnarosDailyRefresh(),
            default => new NormalDailyRefresh(),
        };
    }
}
