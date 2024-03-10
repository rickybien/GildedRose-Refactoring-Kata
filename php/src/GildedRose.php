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
                    $agedBrie = new Conjured($item);
                    $agedBrie->calculate();
                    break;
                default:
                    $agedBrie = new General($item);
                    $agedBrie->calculate();
                    break;
            }
        }
    }
}
