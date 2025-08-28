<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;
    private const AGED_BRIE = 'Aged Brie';
    private const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    private const BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';
    private const CONJURED = 'Conjured';

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        $mappingClass = [
            self::AGED_BRIE => AgedBrieItem::class,
            self::SULFURAS => SulfurasItem::class,
            self::BACKSTAGE => BackstageItem::class,
            self::CONJURED => ConjuredItem::class,
        ];
        foreach ($this->items as $item) {
            $className = $mappingClass[$item->name] ?? NormalItem::class;
            $class = new $className($item);
            $class->updateQuality($item);
        }
    }
}
