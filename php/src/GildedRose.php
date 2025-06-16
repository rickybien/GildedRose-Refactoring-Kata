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
                case "Sulfuras, Hand of Ragnaros":
                    //"Sulfuras" 是一个传奇物品，因此它的品质是80且永远不变
                    $item->sellIn += 1;
                    continue 2;
                case "Aged Brie":
                    //"Aged Brie" 的品质`Quality`会随着时间推移而提高
                    $item->quality += 1;
                    if ($item->sellIn < 0) {
                        $item->quality += 1;
                    }
                    break;
                case "Backstage passes to a TAFKAL80ETC concert":
                    //品质`Quality`会随着时间推移而提高；
                    //当还剩10天或更少的时候，品质`Quality`每天提高2；
                    //当还剩5天或更少的时候，品质`Quality`每天提高3；
                    //但一旦过期，品质就会降为0
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
                    //品质`Quality`下降速度比正常物品快一倍
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
