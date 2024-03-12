<?php

declare(strict_types=1);

namespace GildedRose;

use ReflectionClass;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    private $class = [
        'normal' =>  "GildedRose\\normal",
        'Aged Brie' => "GildedRose\\AgedBrie",
        'Backstage passes to a TAFKAL80ETC concert' => "GildedRose\\BackstagePasses",
        'Sulfuras, Hand of Ragnaros' => "GildedRose\\Sulfuras",
        'Conjured' => "GildedRose\\Conjured"
    ];

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {   
            $classObj = new ReflectionClass($this->class[$item->name]);
            $classInstance = $classObj->newInstance();
            $classInstance->updateQuality($item);
        }
    }
}
