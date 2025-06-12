<?php
/**
 * 所有物品的interface
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/4
 * @since 0.1.0 2024/12/4 eden.chen: 新建立Item Interface
 */

namespace GildedRose\Items;
/**
 *  Item Interface
 *
 * @package GildedRose\Items
 */
interface ItemInterface
{
    /**
     * 品質更新
     *
     * @return void
     */
    public function triggerUpdateQuality(): void;
}