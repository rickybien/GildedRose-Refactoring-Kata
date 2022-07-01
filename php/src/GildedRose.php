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
                    $maxQty = 50;
                    $minQty = 0;
                    --$item->sellIn;
                    if ($item->sellIn < 0) {
                        $item->quality = $this->addQty($item->quality, 2, $maxQty, $minQty);
                    }else {
                        $item->quality = $this->addQty($item->quality, 1, $maxQty, $minQty);
                    }
                    return;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $maxQty = 50;
                    $minQty = 0;
                    --$item->sellIn;

                    $item->quality = $this->addQty($item->quality, 1, $maxQty, $minQty);

                    if ($item->sellIn < 10) {
                        $item->quality = $this->addQty($item->quality, 1, $maxQty, $minQty);
                    }
                    if ($item->sellIn < 5) {
                        $item->quality = $this->addQty($item->quality, 1, $maxQty, $minQty);
                    }
                    if ($item->sellIn < 0) {
                        $item->quality = 0;
                    }
                    return;
                case 'Sulfuras, Hand of Ragnaros':
                    // $maxQty = 80;
                    // $item->quality = $maxQty; // ?? 不確定
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
