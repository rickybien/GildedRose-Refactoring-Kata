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
            if ($item->name == 'Sulfuras, Hand of Ragnaros') {
                continue;
            }

            $item->sellIn = $item->sellIn - 1;

            switch ($item->name) {
                case 'Aged Brie':
                    if ($item->sellIn < 0) {
                        $item->quality += 2;
                    } else {
                        $item->quality += 1;
                    }
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    if ($item->sellIn < 0) {
                        $item->quality = 0;
                        break;
                    }
                    $item->quality += 1;
                    if ($item->sellIn < 10) {
                        $item->quality += 1;
                    }
                    if ($item->sellIn < 5) {
                        $item->quality += 1;
                    }
                    break;
                case 'Conjured':
                    $item = $this->updateNormalItemQuality($item, 2);
                    break;
                default:
                    $item = $this->updateNormalItemQuality($item);
                    break;
            }

            $item->quality = max($item->quality, 0);
            $item->quality = min($item->quality, 50);
        }
    }

    private function updateNormalItemQuality($item, int $times = 1)
    {
        if ($item->sellIn < 0) {
            $item->quality -= (2 * $times);

            return $item;
        }
        $item->quality -= (1 * $times);

        return $item;
    }
}
