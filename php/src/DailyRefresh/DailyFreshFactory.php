<?php

declare(strict_types=1);

namespace GildedRose\DailyRefresh;

use GildedRose\Enums\ItemName;

class DailyFreshFactory
{
    public static function createDailyFresh($name): DailyFreshInterface
    {
        return match ($name) {
            ItemName::AGED_BRIE->value => new AgedBrieDailyRefresh(),
            ItemName::BACKSTAGE_PASSES->value => new BackstagePassesTAFKAL80ETCDailyRefresh(),
            ItemName::HandofRagnaros->value => new HandofRagnarosDailyRefresh(),
            ItemName::Conjured->value => new ConjuredDailyRefresh(),
            default => new NormalDailyRefresh(),
        };
    }
}
