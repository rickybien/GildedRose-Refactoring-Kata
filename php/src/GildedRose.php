<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;
    private const AGED_BRIE = 'Aged Brie';
    private const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    private const BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item->name === self::SULFURAS) {
                continue;
            }

            $num = $this->isExpired($item) ? 2 : 1;

            if ($item->name === self::AGED_BRIE) {
                $this->increaseQuality($item, $num);
            } elseif ($item->name === self::BACKSTAGE) {
                if ($this->isExpired($item)) {
                    $item->quality = 0;
                    $item->sellIn--;
                    continue;
                }
                $num = $this->calculateNum($item);

                $this->increaseQuality($item, $num);
            } else {
                $this->decreaseQuality($item, $num);
            }

            $item->sellIn--;
        }
    }

    private function increaseQuality(Item $item, int $multiple): void
    {
        $item->quality = min($item->quality + $multiple, 50);
    }

    private function decreaseQuality(Item $item, int $multiple): void
    {
        $item->quality = max($item->quality - $multiple, 0);
    }

    private function isExpired(Item $item): bool
    {
        return $item->sellIn <= 0;
    }

    private function calculateNum(Item $item): int
    {
        $num = 1;
        if ($item->sellIn <= 5) {
            $num = 3;
        } elseif ($item->sellIn <= 10) {
            $num = 2;
        }
        return $num;
    }
}
