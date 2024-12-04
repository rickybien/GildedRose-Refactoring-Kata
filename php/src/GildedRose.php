<?php
/**
 * Gilded Rose的Class
 *
 * @version 0.2.1
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/4
 * @since 0.1.0 2024/12/4 eden.chen: 新建立PHPDoc
 * @since 0.1.1 2024/12/4 eden.chen: 重構，替換常用常數
 * @since 0.1.2 2024/12/4 eden.chen: 重構，處理quality下降
 * @since 0.1.3 2024/12/4 eden.chen: 重構，處理過期物品
 * @since 0.2.0 2024/12/4 eden.chen: 增加Conjured規則
 * @since 0.2.1 2024/12/4 eden.chen: 補齊PHPDoc
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

    const QUALITY_RATE = [
        'normal' => 1,
        'double' => 2,
        'triple' => 3,
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
            // 處理quality下降
            if (($item->name === self::ITEM['agedBrie']) || ($item->name === self::ITEM['backstage'])) {
                // 特殊物品，quality上升
                if ($item->quality < self::MAX_QUALITY['normal']) {
                    if ($item->name === self::ITEM['backstage']) {
                        // backstage依規則上升
                        $item->quality = match (true) {
                            $item->sellIn < 6 => $item->quality + self::QUALITY_RATE['triple'],
                            $item->sellIn < 11 => $item->quality + self::QUALITY_RATE['double'],
                            default => $item->quality + self::QUALITY_RATE['normal'],
                        };
                    } else {
                        // 其餘特殊物品上升1
                        $item->quality = $item->quality + self::QUALITY_RATE['normal'];
                    }
                }
            }elseif ($item->name !== self::ITEM['sulfuras']) {
                // 撇除傳奇物品，其餘物品下降
                if ($item->name === self::ITEM['conjured']) {
                    $item->quality = match (true) {
                        $item->quality < self::QUALITY_RATE['double'] => 0,
                        default => $item->quality - self::QUALITY_RATE['double'],
                    };
                }else{
                    if ($item->quality > self::MIN_QUALITY) {
                        $item->quality = $item->quality - self::QUALITY_RATE['normal'];
                    }
                }
            }

            // 處理有效期限下降
            // 撇除傳奇物品，其餘物品有效期限下降
            if ($item->name !== self::ITEM['sulfuras']) {
                $item->sellIn = $item->sellIn - 1;
            }

            // 處理過期物品，品質變化加快
            if ($item->sellIn < self::MIN_QUALITY) {
                if ($item->name !== self::ITEM['sulfuras']) {
                    // 撇除傳奇物品
                    if ($item->name === self::ITEM['agedBrie']) {
                        if ($item->quality < self::MAX_QUALITY['normal']) {
                            $item->quality = $item->quality + 1;
                        }
                    } elseif ($item->name === self::ITEM['backstage']) {
                        $item->quality = 0;
                    } elseif ($item->name === self::ITEM['conjured']) {
                        $item->quality = match (true) {
                            $item->quality < self::QUALITY_RATE['double'] => 0,
                            default => $item->quality - self::QUALITY_RATE['double'],
                        };
                    } else {
                        if ($item->quality > self::MIN_QUALITY) {
                            $item->quality = $item->quality - 1;
                        }
                    }
                }
            }
        }
    }
}
