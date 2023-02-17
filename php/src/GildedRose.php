<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Item;

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
            $this->sellInModify($item); // 日期先前進，再統一處理品質
            $this->qualityModify($item);
        }
    }

    private function sellInModify(Item &$item)
    {
        // 永不過期
        if ($item->name === 'Sulfuras, Hand of Ragnaros') return;
        
        $item->sellIn--;
    }

    private function qualityModify(Item &$item)
    {
        $name = $item->name;
        $quality = &$item->quality;
        $sellIn = $item->sellIn;

        // 預設品質變化量
        $qualityModify = -1;

        // 過期後，品質變化速度提升
        if ($sellIn < 0) $qualityModify *= 2;

        // 客製品質變化量
        switch ($name) {
            case 'Sulfuras, Hand of Ragnaros':
                $qualityModify = 0;
                break;
            case 'Aged Brie':
                if ($sellIn < 0) $qualityModify = 2;
                else $qualityModify = 1;
                break;
            case 'Backstage passes to a TAFKAL80ETC concert':
                if ($sellIn < 0) $qualityModify = -$quality;
                elseif ($sellIn < 5) $qualityModify = 3;
                elseif ($sellIn < 10) $qualityModify = 2;
                elseif ($sellIn < 49) $qualityModify = 1;
                break;
            case 'Conjured':
                $qualityModify *= 2; // 召喚物，兩倍品質腐敗速度
                break;
        }

        $quality += $qualityModify;

        if ($quality < 0) $quality = 0;
        if ($quality > 50) $quality = 50;
    }
}
