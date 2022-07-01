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
                    $this->updateQualityA($item);
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $this->updateQualityB($item);
                    break;
                case 'Sulfuras, Hand of Ragnaros':
                    $this->updateQualityS($item);
                    break;
                case 'Conjured':
                    $this->updateQualityC($item);
                    break;
                default:
                    $this->updateQualityN($item);
                    break;
            }
        }
    }

    private function updateQualityA(Item $item): void
    {
        $item->sellIn = $item->sellIn -1;
        $qualityRate = 1;
        if ($item->sellIn < 0) {
            $qualityRate *= 2;
        }
        $item->quality = min($item->quality + $qualityRate, 50);
    }

    private function updateQualityB(Item $item): void
    {
        $item->sellIn = $item->sellIn -1;
        $qualityRate = 1;
        if ($item->sellIn < 0) {
            $item->quality = 0;
            return;
        }
        if ($item->sellIn < 10) {
            $qualityRate = 2;
            if ($item->sellIn < 5) {
                $qualityRate = 3;
            }
        }
        $item->quality = min($item->quality + $qualityRate, 50);
    }

    private function updateQualityS(Item $item): void
    {
    }

    private function updateQualityC(Item $item): void
    {
        $item->sellIn = $item->sellIn -1;
        $qualityRate = 1;
        $qualityRate *= 2;
        if ($item->sellIn < 0) {
            $qualityRate *= 2;
        }
        $item->quality = max($item->quality - $qualityRate, 0);
    }

    private function updateQualityN(Item $item): void
    {
        $item->sellIn = $item->sellIn -1;
        $qualityRate = 1;
        if ($item->sellIn < 0) {
            $qualityRate *= 2;
        }
        $item->quality = max($item->quality - $qualityRate, 0);
    }
}
