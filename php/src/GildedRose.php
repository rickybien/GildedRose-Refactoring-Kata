<?php

declare(strict_types=1);

namespace GildedRose;

// 物品名 陳年布利奶酪
define('HIGHEST_QUALITY', 50);
define('ITEM_NAME_CHEESE', 'Aged Brie');
define('ITEM_NAME_PASSES', 'Backstage passes to a TAFKAL80ETC concert');
define('ITEM_NAME_SULFURAS', 'Sulfuras, Hand of Ragnaros');
define('PASSES_CLOSE_TO_SELL_DATE', 10);
define('PASSES_VERY_CLOSE_TO_SELL_DATE', 5);

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
            switch ($item->name) {
                // 传奇物品"Sulfuras"（萨弗拉斯—炎魔拉格纳罗斯之手）永不过期，也不会降低品质`Quality`
                // 不會減銷售期限，也不會降低品質
                case ITEM_NAME_SULFURAS:
                    break;

                // "Aged Brie"（陈年布利奶酪）的品质`Quality`会随着时间推移而提高
                // 減銷售期限，提升品質
                //  (一旦销售期限过期，品质`Quality`会以双倍速度加速提升)
                case ITEM_NAME_CHEESE:
                    $this->decreaseSellIn($item);
                    $increaseQualityNum = $item->sellIn < 0 ? 2 : 1;
                    $this->increaseQuality($item, $increaseQualityNum);
                    break;

                // "Backstage passes"（后台通行证）与"Aged Brie"（陈年布利奶酪）类似，其品质`Quality`会随着时间推移而提高；
                //	当还剩10天或更少的时候，品质`Quality`每天提高2；
                //	当还剩5天或更少的时候，品质`Quality`每天提高3；
                //  但一旦过期，品质就会降为0
                case ITEM_NAME_PASSES:
                    if ($item->sellIn > PASSES_CLOSE_TO_SELL_DATE) {
                        $this->increaseQuality($item, 1);
                    } elseif ($item->sellIn <= PASSES_VERY_CLOSE_TO_SELL_DATE) {
                        $this->increaseQuality($item, 3);
                    } else {
                        $this->increaseQuality($item, 2);
                    }
                    $this->decreaseSellIn($item);
                    if ($item->sellIn < 0) {
                        $item->quality = 0;
                        break;
                    }
                    break;

                // 一般 item
                // 減銷售期限，降低品質
                // 一旦销售期限过期，品质`Quality`会以双倍速度加速下降
                default:
                    $this->decreaseSellIn($item);
                    $decreaseQualityNum = $item->sellIn < 0 ? 2 : 1;
                    $this->decreaseQuality($item, $decreaseQualityNum);
                    break;
            }
        }
    }

    /**
     * 確認物品的品質永遠不會為負值
     * @param Item $item
     */
    private function checkItemQualityGreaterThanZero(Item $item): void
    {
        if ($item->quality < 0) {
            $item->quality = 0;
        }
    }

    /**
     * 確認物品的品質永遠不會超過最高
     * @param Item $item
     */
    private function checkItemQualityLessThanHighest(Item $item): void
    {
        if ($item->quality > HIGHEST_QUALITY) {
            $item->quality = HIGHEST_QUALITY;
        }
    }

    /**
     * 扣銷售期限
     * @param Item $item
     */
    private function decreaseSellIn(Item $item): void
    {
        $item->sellIn--;
    }

    /**
     * 降低品質
     * @param Item $item
     * @param int $num
     */
    private function decreaseQuality(Item $item, int $num): void
    {
        $item->quality -= $num;
        $this->checkItemQualityGreaterThanZero($item);
    }

    /**
     * 增加品質
     * @param Item $item
     * @param int $num
     */
    private function increaseQuality(Item $item, int $num): void
    {
        $item->quality += $num;
        $this->checkItemQualityLessThanHighest($item);
    }
}
