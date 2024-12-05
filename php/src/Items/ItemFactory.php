<?php
/**
 * Item 的 factory
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/5
 * @since 0.1.0 2024/12/5 eden.chen: 新建立ItemFactory class
 */

namespace GildedRose\Items;

use GildedRose\Constant;
use GildedRose\Item;

/**
 * ItemFactory class
 */
class ItemFactory
{
    /**
     * 建立item
     *
     * @param Item $item
     * @return ItemInterface
     */
    public static function create(Item $item): ItemInterface
    {
        return match ($item->name) {
            Constant::ITEM['agedBrie'] => new AgedBrie($item),
            Constant::ITEM['sulfuras'] => new Sulfuras($item),
            Constant::ITEM['backstage'] => new Backstage($item),
            Constant::ITEM['conjured'] => new Conjured($item),
            default => new Normal($item),
        };
    }
}