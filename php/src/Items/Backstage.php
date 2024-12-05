<?php
/**
 * Backstage passes to a TAFKAL80ETC concert 物品
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/4
 * @since 0.1.0 2024/12/4 eden.chen: 新建立Backstage class
 */

namespace GildedRose\Items;

/**
 * Backstage class 繼承 Normal
 */
class Backstage extends Normal
{
    /**
     * 更新品質
     *
     * @return void
     */
    public function updateQuality(): void
    {
        if ($this->item->sellIn < 0) {
            // 已過期，直接變0
            $this->item->quality = 0;
        }else{
            // 未過期
            match (true) {
                $this->item->sellIn < 5 => $this->item->quality += 3,
                $this->item->sellIn < 10 => $this->item->quality += 2,
                default => $this->item->quality += $this->qualityRate,
            };
        }
    }
}