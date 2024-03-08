<?php

declare(strict_types=1);

namespace GildedRose;

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
            if ($item->name === 'Sulfuras, Hand of Ragnaros') {
                $item->quality = 80;
                continue;
            }

            match ($item->name) {
                'Aged Brie' => $this->updateAgedBrieItem($item),
                'Backstage passes to a TAFKAL80ETC concert' => $this->updateBackstagePassesItem($item),
                'Conjured' => $this->updateConjuredItem($item),
                default => $this->updateNormalItem($item),
            };

        }
    }

    private function calculateQuality(int $quality, $type = '-'): int
    {
        if ($quality <= 0) {
            return 0;
        }

        if ($type === '-') {
            $quality--;
        } else {
            $quality++;
        }

        if ($quality > 50) {
            $quality = 50;
        }

        return $quality;
    }

    private function updateNormalItem(Item $item): void
    {
        $item->sellIn--;
        $n = 1;
        if ($item->sellIn < 0) {
            $n++;
        }
        for ($i = 0; $i < $n; $i++) {
            $item->quality = $this->calculateQuality($item->quality);
        }

    }

    private function updateAgedBrieItem(Item $item): void
    {
        $item->sellIn--;
        $n = 1;
        if ($item->sellIn < 0) {
            $n++;
        }
        for ($i = 0; $i < $n; $i++) {
            $item->quality = $this->calculateQuality($item->quality, '+');
        }
    }

    private function updateBackstagePassesItem(Item $item): void
    {
        $item->sellIn--;

        if ($item->sellIn < 0) {
            $item->quality = 0;
            return;
        }

        $n = 1;
        if ($item->sellIn < 10) {
            $n++;
        }

        if ($item->sellIn < 5) {
            $n++;
        }

        for ($i = 0; $i < $n; $i++) {
            $item->quality = $this->calculateQuality($item->quality, '+');
        }
    }

    private function updateConjuredItem(Item $item): void
    {
        $item->sellIn--;
        $n = 1;
        if ($item->sellIn < 0) {
            $n++;
        }
        $n *= 2;
        for ($i = 0; $i < $n; $i++) {
            $item->quality = $this->calculateQuality($item->quality);
        }
    }
}