<?php
/**
 * 常用的常數
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/4
 * @since 0.1.0 2024/12/4 eden.chen: 新建立Constant class
 */

namespace GildedRose;

/**
 * Constant Class
 */
class Constant
{
    /**
     *  品質最大值
     */
    const MAX_QUALITY = 50;

    /**
     *  品質最小值
     */
    const MIN_QUALITY = 0;

    /**
     *  品質變化率
     */
    const QUALITY_RATE = [
        'normal' => 1,
        'double' => 2,
    ];

    /**
     *  物品名稱
     */
    const ITEM = [
        'agedBrie' => 'Aged Brie',
        'backstage' => 'Backstage passes to a TAFKAL80ETC concert',
        'conjured' => 'Conjured',
        'sulfuras' => 'Sulfuras, Hand of Ragnaros',
    ];

    /**
     *  物品規則
     */
    const ITEM_RULE = [
        'normal' => [
            'agedBrie' => [
                'name' => self::ITEM['agedBrie'],
                'qualityType' => 'increase',
                'qualityRate' => self::QUALITY_RATE['normal'],
            ],
            'backstage' => [
                'name' => self::ITEM['backstage'],
                'qualityType' => 'increase',
                'qualityRate' => self::QUALITY_RATE['normal'],
            ],
            'conjured' => [
                'name' => self::ITEM['conjured'],
                'qualityType' => 'decrease',
                'qualityRate' => self::QUALITY_RATE['double'],
            ],
            'other' => [
                'name' => 'Other',
                'qualityType' => 'decrease',
                'qualityRate' => self::QUALITY_RATE['normal'],
            ]
        ],
        'legend' => [
            'sulfuras' => [
                'name' => self::ITEM['sulfuras'],
            ]
        ]
    ];
}