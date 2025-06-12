<?php
/**
 * Aged Brie 物品
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/4
 * @since 0.1.0 2024/12/4 eden.chen: 新建立AgedBrie class
 */

namespace GildedRose\Items;

/**
 * Aged Brie class 繼承 Normal
 *
 * @package GildedRose\Items
 */
class AgedBrie extends Normal
{
    /**
     * 複寫updateQuality
     *
     * @return void
     */
    protected function updateQuality(): void
    {
        if ($this->item->sellIn < 0) {
            // 已過期，過期為雙倍變化
            $this->item->quality += (2 * $this->qualityRate);
        }else{
            // 未過期
            $this->item->quality += $this->qualityRate;
        }
    }
}