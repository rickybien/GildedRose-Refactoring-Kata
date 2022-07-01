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
                    $class = new AgedBrie($item);
                    $class->clac();
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $class = new Backstage($item);
                    $class->clac();
                    break;

                case 'Sulfuras, Hand of Ragnaros':
                    $class = new Sulfuras($item);
                    $class->clac();
                    break;
                case 'normal':
                    $class = new Normal($item);
                    $class->clac();
                    break;
                    
            }
        }
    }
}
