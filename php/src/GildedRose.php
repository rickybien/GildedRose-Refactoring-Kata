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
    private const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    private const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    private const CONJURED = 'Conjured';


    public function __construct(array $items)
    {
        $this->items = $items;
    }

//    public function updateQuality(): void
//    {
//        foreach ($this->items as $item) {
//            if ($item->name !== self::AGED_BRIE && $item->name !== self::BACKSTAGE_PASSES) {
//                if ($item->quality > 0) {
//                    if ($item->name !== self::SULFURAS) {
//                        $item->quality = $item->quality - 1;
//                    }
//                }
//            } else {
//                if ($item->quality < 50) {
//                    $item->quality = $item->quality + 1;
//                    if ($item->name === self::BACKSTAGE_PASSES) {
//                        if ($item->sellIn < 11) {
//                            if ($item->quality < 50) {
//                                $item->quality = $item->quality + 1;
//                            }
//                        }
//                        if ($item->sellIn < 6) {
//                            if ($item->quality < 50) {
//                                $item->quality = $item->quality + 1;
//                            }
//                        }
//                    }
//                }
//            }
//
//            if ($item->name !== self::SULFURAS) {
//                $item->sellIn = $item->sellIn - 1;
//            }
//
//            if ($item->sellIn < 0) {
//                if ($item->name !== self::AGED_BRIE) {
//                    if ($item->name !== self::BACKSTAGE_PASSES) {
//                        if ($item->quality > 0) {
//                            if ($item->name !== self::SULFURAS) {
//                                --$item->quality;
//                            }
//                        }
//                    } else {
//                        $item->quality -= $item->quality;
//                    }
//                } else {
//                    if ($item->quality < 50) {
//                        ++$item->quality;
//                    }
//                }
//            }
//        }
//    }

    public function updateQuality()
    {
        foreach ($this->items as $item) {
            $itemCalculate = match ($item->name) {
                self::AGED_BRIE => new AgedBrie(),
                self::BACKSTAGE_PASSES => new BackStage(),
                self::SULFURAS => new Sulfuras(),
                self::CONJURED => new Conjured(),
                default => new Normal(),
             };

            $item->sellIn = $itemCalculate->calculateSellIn($item->sellIn);
            $item->quality = $itemCalculate->calculateQuality($item->sellIn, $item->quality);
        }
    }
}
