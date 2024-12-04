<?php
/**
 * Gilded Rose的Class
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/4
 * @since 0.1.0 2024/12/4 eden.chen: 新建立PHPDoc
 */
declare(strict_types=1);

namespace GildedRose;

/**
 * Gilded Rose Class
 */
final class GildedRose
{
    /**
     * 注入的物品item
     *
     * @var Item[]
     */
    private array $items;

    const ITEM = [
        'agedBrie' => 'Aged Brie',
        'backstage' => 'Backstage passes to a TAFKAL80ETC concert',
        'sulfuras' => 'Sulfuras, Hand of Ragnaros',
        'conjured' => 'Conjured',
    ];

    const MAX_QUALITY = [
        'normal' => 50,
        'legend' => 80,
    ];

    const MIN_QUALITY = 0;

    const QUALITY_DECREASE_RATE = [
        'normal' => 1,
        'double' => 2,
    ];

    /**
     * construct
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * 更新品質與有效期限
     *
     * @return void
     */
    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item->name != self::ITEM['agedBrie'] and $item->name != self::ITEM['backstage']) {
                if ($item->quality > self::MIN_QUALITY) {
                    if ($item->name != self::ITEM['sulfuras']) {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                if ($item->quality < self::MAX_QUALITY['normal']) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == self::ITEM['backstage']) {
                        if ($item->sellIn < 11) {
                            if ($item->quality < self::MAX_QUALITY['normal']) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sellIn < 6) {
                            if ($item->quality < self::MAX_QUALITY['normal']) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            if ($item->name != self::ITEM['sulfuras']) {
                $item->sellIn = $item->sellIn - 1;
            }

            if ($item->sellIn < self::MIN_QUALITY) {
                if ($item->name != self::ITEM['agedBrie']) {
                    if ($item->name != self::ITEM['backstage']) {
                        if ($item->quality > self::MIN_QUALITY) {
                            if ($item->name != self::ITEM['sulfuras']) {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = 0;
                    }
                } else {
                    if ($item->quality < self::MAX_QUALITY['normal']) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}
