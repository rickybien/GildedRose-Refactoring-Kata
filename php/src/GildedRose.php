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
            $itemClass = ItemFactory::getItemClass($item->name);
            $itemClass->setQuality($item->quality);
            $itemClass->setSellIn($item->sellIn);
            $itemClass->modifyQuality();
            $itemClass->modifySellIn();
            $item->quality = $itemClass->getQuality();
            $item->sellIn = $itemClass->getSellIn();
        }
    }
}