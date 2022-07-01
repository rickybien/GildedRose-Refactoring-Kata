<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    public const CLAC_MAPPING = [
        'Aged Brie' => AgedBrie::class,
        'Backstage passes to a TAFKAL80ETC concert' => Backstage::class,
        'Sulfuras, Hand of Ragnaros' => Sulfuras::class,
        'normal' => Normal::class,
        'Conjured' => Conjured::class,
    ];
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
            $mapping = self::CLAC_MAPPING[$item->name] ?? Nothing::class;
            $class = new $mapping($item);
            $class->clac();
        }
    }
}
