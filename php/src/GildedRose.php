<?php
/**
 * Gilded Rose的Class
 *
 * @version 0.2.2
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/4
 * @since 0.1.0 2024/12/4 eden.chen: 新建立PHPDoc
 * @since 0.1.1 2024/12/4 eden.chen: 重構，替換常用常數
 * @since 0.1.2 2024/12/4 eden.chen: 重構，處理quality下降
 * @since 0.1.3 2024/12/4 eden.chen: 重構，處理過期物品
 * @since 0.2.0 2024/12/4 eden.chen: 增加Conjured規則
 * @since 0.2.1 2024/12/4 eden.chen: 補齊PHPDoc
 * @since 0.2.2 2024/12/4 eden.chen: 整個重構updateQuality
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
            // 撇除傳奇品質物品，傳奇品質什麼都不用動
            if (!array_filter(Constant::ITEM_RULE['legend'], function ($value) use ($item) {
                return $value['name'] == $item->name;
            })) {
                // 處理有效期限
                $item->sellIn = $item->sellIn - 1;

                // 處理quality變化
                $itemRule = match ($item->name) {
                    Constant::ITEM_RULE['normal']['agedBrie']['name'] => Constant::ITEM_RULE['normal']['agedBrie'],
                    Constant::ITEM_RULE['normal']['backstage']['name'] => Constant::ITEM_RULE['normal']['backstage'],
                    Constant::ITEM_RULE['normal']['conjured']['name'] => Constant::ITEM_RULE['normal']['conjured'],
                    default => CONSTANT::ITEM_RULE['normal']['other'],
                };
                if ($item->sellIn < 0) {
                    // 過期，以雙倍速變化
                    if ($itemRule['qualityType'] === 'increase') {
                        $item->quality = match ($item->name) {
                            Constant::ITEM['backstage'] => 0,
                            default => $item->quality + (2 * $itemRule['qualityRate']),
                        };
                    } else {
                        $item->quality = $item->quality - (2 * $itemRule['qualityRate']);
                    }
                }else{
                    // 未過期
                    if ($itemRule['qualityType'] === 'increase') {
                        $item->quality = match ($item->name) {
                            Constant::ITEM['backstage'] => match (true) {
                                // 剩餘5天時，提高3
                                $item->sellIn < 5 => $item->quality + 3,
                                // 剩餘10天時，提高2
                                $item->sellIn < 10 => $item->quality + 2,
                                default => $item->quality + $itemRule['qualityRate'],
                            },
                            default => $item->quality + $itemRule['qualityRate'],
                        };
                    } else {
                        $item->quality = $item->quality - $itemRule['qualityRate'];
                    }
                }
                // 判斷是否超過boundary
                $item->quality = max(Constant::MIN_QUALITY, min(Constant::MAX_QUALITY, $item->quality));
            }
        }
    }
}
