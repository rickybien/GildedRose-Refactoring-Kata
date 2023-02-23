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
                case "Conjured":
                    $item = $this->defaultQualityRule($item);
                default:
                    $item = $this->defaultQualityRule($item);
            }

            $item->quality = ($item->quality < 0) ? 0 : $item->quality;
            $item->quality = ($item->quality > 50) ? 50 : $item->quality;
        }
    }

    private function defaultQualityRule($item)
    {
        $item->quality -= 1;
        if ($item->sellIn < 0) {
            $item->quality -= 1;
        }

        return $item;
    }
}
