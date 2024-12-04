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
    private $items;

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
            if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->quality > 0) {
                    if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sellIn < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sellIn < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->sellIn = $item->sellIn - 1;
            }

            if ($item->sellIn < 0) {
                if ($item->name != 'Aged Brie') {
                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->quality > 0) {
                            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}
