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
        $this->itemNormal = new ItemNormal();
        $this->itemAgedBrie =  new ItemAgedBrie();
        $this->itemSulfuras = new ItemSulfuras();
        $this->itemBackstagePasses = new ItemBackstagePasses();
        $this->itemConjured  = new ItemConjured();
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