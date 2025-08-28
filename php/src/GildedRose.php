<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    private $items;
    private $maxQuality = 50;
    private $minQuality = 0;
    /**
     * @param Item[] $items
     */

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as &$item) {
            switch ($item->name) {
                case 'Aged Brie':
                    $plusNum = $item->sellIn > 0 ? 1 : 2;
                    $item->quality= $this->plusQlty($item->quality, $plusNum);
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    if ($item->sellIn <= 0) {
                        $item->quality = 0;
                    } elseif ($item->sellIn <= 5) {
                        $item->quality = $this->plusQlty($item->quality, 3);
                    } elseif ($item->sellIn <= 10) {
                        $item->quality = $this->plusQlty($item->quality, 2);
                    } else {
                        $item->quality = $this->plusQlty($item->quality, 1);
                    }
                    break;
                case 'Sulfuras, Hand of Ragnaros':
                    $item->quality = 80;
                    break;
                case 'Conjured':
                    $minusNum = $item->sellIn > 0 ? 2 : 4;
                    $item->quality = $this->minusQlty($item->quality, $minusNum);
                    break;
                default:
                    $minusNum = $item->sellIn > 0 ? 1 : 2;
                    $item->quality = $this->minusQlty($item->quality, $minusNum);
                    break;
            }
            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->sellIn = $item->sellIn - 1;
            }
        }
    }

    private function plusQlty(int $qlty, int $plus): int
    {
        return $qlty + $plus < $this->maxQuality ? $qlty + $plus : $this->maxQuality;
    }

    private function minusQlty(int $quality, int $minusNumber): int
    {
        return $quality - $minusNumber > $this->minQuality ? $quality - $minusNumber : $this->minQuality;
    }
}
