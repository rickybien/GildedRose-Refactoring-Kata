<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /** 預設時間流逝速度 */
    const DATE_FLIES = 1;
    /** 預設商品過期流逝倍率 */
    const QUALITY_OVER_TERM_MAGNIFICATION = 2;
    /** 預設商品價值上限 */
    const QUALITY_DEFAULT_RANGE = [
        'default_up' => 50,
        'default_down' => 0,
        'Sulfuras, Hand of Ragnaros' => 80
    ];
    /** 預設商品流逝價值 */
    const QUALITY_PASSES_LESS = [
        'default' => -1,
        'Conjured' => -2
    ];
    /** 預設商品增值價值 */
    const QUALITY_PASSES_INCREASE = [
        'default' => 1,
        'Backstage_passes_less_10' => 2,
        'Backstage_passes_less_5' => 3,
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
            $item->sellIn = $item->sellIn - self::DATE_FLIES;
            switch ($item->name) {
                case 'Aged Brie': // 永不過期，且隨著時間品質提高
                    if ($item->sellIn >= 0) {
                        $item->quality += self::QUALITY_PASSES_INCREASE['default'];
                    } else {
                        $item->quality += self::QUALITY_PASSES_INCREASE['default'] * self::QUALITY_OVER_TERM_MAGNIFICATION;
                    }
                    break;
                case 'Sulfuras, Hand of Ragnaros': // 永不過期，品質不變
                    $item->sellIn += self::DATE_FLIES;
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert': // 隨著到期日越接近價值越高
                    if ($item->sellIn < 0) {
                        $item->quality = self::QUALITY_DEFAULT_RANGE["default_down"];
                    } elseif (5 > $item->sellIn && $item->sellIn >= 0) {
                        $item->quality += self::QUALITY_PASSES_INCREASE['Backstage_passes_less_5'];
                    } elseif (10 > $item->sellIn && $item->sellIn >= 5) {
                        $item->quality += self::QUALITY_PASSES_INCREASE['Backstage_passes_less_10'];
                    } else {
                        $item->quality += self::QUALITY_PASSES_INCREASE['default'];
                    }
                    break;
                case 'Conjured': // 品質下降比正常速度快一倍
                    if ($item->sellIn < 0) {
                        $item->quality += self::QUALITY_PASSES_LESS['Conjured'] * self::QUALITY_OVER_TERM_MAGNIFICATION;
                    } else {
                        $item->quality += self::QUALITY_PASSES_LESS['Conjured'];
                    }

                    break;
                default:
                    if ($item->sellIn < 0) {
                        $item->quality += self::QUALITY_PASSES_LESS['default'] * self::QUALITY_OVER_TERM_MAGNIFICATION;
                    } else {
                        $item->quality += self::QUALITY_PASSES_LESS['default'];
                    }

                    break;
            }
            if ($item->quality >= self::QUALITY_DEFAULT_RANGE['default_up'] && $item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->quality = self::QUALITY_DEFAULT_RANGE['default_up'];
            } elseif ($item->quality < self::QUALITY_DEFAULT_RANGE['default_down']) {
                $item->quality = self::QUALITY_DEFAULT_RANGE['default_down'];
            }
        }
    }
}
