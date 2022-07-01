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
                    $this->agedBrie($item);
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $this->backstage($item);
                    break;

                case 'Sulfuras, Hand of Ragnaros':
                    break;
                case 'normal':
                    $this->normal($item);
                    break;
                    
            }
        }
    }

    public function normal($item): void
    {
        $item->sellIn = $item->sellIn - 1;
        $item->quality = $item->quality - 1;

        if ($item->sellIn < 0) {
            $item->quality = $item->quality - 1;
        }

        if ($item->quality < 0) {
            $item->quality = 0;
        }
    }

    public function agedBrie($item): void
    {
        $item->sellIn = $item->sellIn - 1;

        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;

            if ($item->sellIn < 0 && $item->quality < 50) {
                $item->quality = $item->quality + 1;
            }
        }
    }
    public function backstage($item): void
    {
        $item->sellIn = $item->sellIn - 1;

        if ($item->sellIn < 0) {
            $item->quality = 0;
            return;
        }

        $item->quality = $item->quality + 1;

        if ($item->sellIn > 0 && $item->sellIn <= 5) {
            $item->quality = $item->quality + 2;
        }

        if ($item->sellIn > 5 && $item->sellIn < 10) {
            $item->quality = $item->quality + 1;
        }

        if ($item->quality >= 50) {
            $item->quality = 50;
        }
    }

}
