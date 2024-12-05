<?php
/**
 * Conjured 物品
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/5
 * @since 0.1.0 2024/12/5 eden.chen: 新建立Conjured class
 */

namespace GildedRose\Items;

/**
 * Conjured class 繼承 Normal
 */
class Conjured extends Normal
{
    /**
     * 品質變化率，比正常物品快一倍
     *
     * @var int
     */
    protected int $qualityRate = 2;
}