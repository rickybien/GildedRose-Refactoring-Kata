<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\DailyRefresh\DailyFreshFactory;
use GildedRose\DailyRefresh\DailyFreshInterface;
use GildedRose\DailyRefresh\DailyRefreshInfoDto;
use GildedRose\Enums\ItemName;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $dailyFresh = DailyFreshFactory::createDailyFresh($item->name);
            $info = $this->getDailyRefreshInfo($dailyFresh, $item);
            $item->quality = $this->maxQualityRestrict($info->quality, $item->name);
            $item->sellIn = $info->sellIn;
        }
    }

    private function getDailyRefreshInfo(DailyFreshInterface $dailyFresh, Item $item): DailyRefreshInfoDto
    {
        $qualityDecreaseRate = $this->getQualityDecreaseRate($item->sellIn);
        $qualityDecrease = $qualityDecreaseRate * $dailyFresh->qualityDecrease($item->sellIn, $item->quality);

        return new DailyRefreshInfoDto(
            $item->sellIn - $dailyFresh->sellInDecrease(),
            $item->quality - $qualityDecrease
        );
    }

    private function getQualityDecreaseRate(int $sellIn): int
    {
        return $sellIn <= 0 ? 2 : 1;
    }

    private function maxQualityRestrict(int $quality, string $itemName): int
    {
        $maxQuality = $itemName === ItemName::HandofRagnaros->value ? 80 : 50;

        return min($quality, $maxQuality);
    }
}
