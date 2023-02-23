<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $item->sellIn -= 1;
            switch ($item->name) {
                case "Aged Brie":
                    $item->quality += 1;
                    if ($item->sellIn < 0) {
                        $item->quality += 1;
                    }
                    break;
                case "Sulfuras, Hand of Ragnaros":
                    $item->sellIn += 1;
                    break;
                case "Backstage passes to a TAFKAL80ETC concert":
                    $item->quality += 1;
                    if ($item->sellIn < 10) {
                        $item->quality += 1;
                    }
                    if ($item->sellIn < 5) {
                        $item->quality += 1;
                    }
                    if ($item->sellIn < 0) {
                        $item->quality = 0;
                    }
                    break;
                default:
                    $item->quality -= 1;
                    if ($item->sellIn < 0) {
                        $item->quality -= 1;
                    }
            }

            if ($item->quality < 0) {
                $item->quality = 0;
            } elseif ($item->quality > 50) {
                $item->quality = 50;
            }
        }
    }
}
