<?php

declare(strict_types=1);

namespace GildedRose;

// 物品名 陳年布利奶酪
define('HIGHEST_QUALITY', 50);
define('ITEM_NAME_CHEESE', 'Aged Brie');
define('ITEM_NAME_PASSES', 'Backstage passes to a TAFKAL80ETC concert');
define('ITEM_NAME_SULFURAS', 'Sulfuras, Hand of Ragnaros');
define('PASSES_CLOSE_TO_SELL_DATE', 11);
define('PASSES_VERY_CLOSE_TO_SELL_DATE', 6);

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
            if ($item->name != ITEM_NAME_CHEESE and $item->name != ITEM_NAME_PASSES) {
                if ($item->quality > 0) {
                    if ($item->name != ITEM_NAME_SULFURAS) {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                if ($item->quality < HIGHEST_QUALITY) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == ITEM_NAME_PASSES) {
                        if ($item->sellIn < PASSES_CLOSE_TO_SELL_DATE) {
                            if ($item->quality < HIGHEST_QUALITY) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sellIn < PASSES_VERY_CLOSE_TO_SELL_DATE) {
                            if ($item->quality < HIGHEST_QUALITY) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            if ($item->name != ITEM_NAME_SULFURAS) {
                $item->sellIn = $item->sellIn - 1;
            }

            if ($item->sellIn < 0) {
                if ($item->name != ITEM_NAME_CHEESE) {
                    if ($item->name != ITEM_NAME_PASSES) {
                        if ($item->quality > 0) {
                            if ($item->name != ITEM_NAME_SULFURAS) {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < HIGHEST_QUALITY) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}
