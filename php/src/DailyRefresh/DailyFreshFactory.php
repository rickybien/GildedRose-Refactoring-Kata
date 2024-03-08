<?php

declare(strict_types=1);

namespace GildedRose\DailyRefresh;

use GildedRose\Enums\ItemName;

class DailyFreshFactory
{
    public static function createDailyFresh($name): DailyFreshInterface
    {
        return match ($name) {
            ItemName::AGED_BRIE => new AgedBrieDailyRefresh(),
            ItemName::BACKSTAGE_PASSES => new BackstagePassesTAFKAL80ETCDailyRefresh(),
            ItemName::HandofRagnaros => new HandofRagnarosDailyRefresh(),
            default => new NormalDailyRefresh(),
        };
    }
}
