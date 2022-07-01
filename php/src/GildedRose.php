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
            switch ($item->name) {
                case 'Aged Brie':
                    $agedBrie = new AgedBrie($item);
                    $agedBrie->calculate();
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $agedBrie = new BackstagePasses($item);
                    $agedBrie->calculate();
                    break;
                case 'Sulfuras, Hand of Ragnaros':
                    $agedBrie = new Sulfuras($item);
                    $agedBrie->calculate();
                    break;
                case 'Conjured':
                    $maxQty = 50;
                    $minQty = 0;
                    --$item->sellIn;
                    $item->quality = $this->addQty($item->quality, -2, $maxQty, $minQty);
                    if ($item->sellIn < 0) {
                        $item->quality = $this->addQty($item->quality, -2, $maxQty, $minQty);
                    }
                    return;
                default:
                    $maxQty = 50;
                    $minQty = 0;
                    --$item->sellIn;
                    $item->quality = $this->addQty($item->quality, -1, $maxQty, $minQty);
                    if ($item->sellIn < 0) {
                        $item->quality = $this->addQty($item->quality, -1, $maxQty, $minQty);
                    }
                    return;
            }
        }
    }

    private function addQty(int $num,int $add, int $max, int $min): int
    {
        $result = $num + $add;
        if ($result > $max) {
            return $max;
        }
        if ($result < $min) {
            return $min;
        }
        return $result;
    }
}
