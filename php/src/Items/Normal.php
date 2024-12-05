<?php
/**
 * 普通物品
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/4
 * @since 0.1.0 2024/12/4 eden.chen: 新建立Normal class
 */

namespace GildedRose\Items;


use GildedRose\Item;

/**
 * Normal class 實作 ItemInterface
 *
 * @package GildedRose\Items
 */
class Normal implements ItemInterface
{
    /**
     * 注入的物品item
     *
     * @var Item
     */
    protected Item $item;

    /**
     *  品質最大值
     *
     * @var int
     */
    protected int $maxQuality = 50;

    /**
     *  品質最小值
     *
     * @var int
     */
    protected int $minQuality = 0;

    /**
     *  品質變化率
     *
     * @var int
     */
    protected int $qualityRate = 1;

    /**
     * construct
     *
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @inheritDoc
     */
    public function triggerUpdateQuality(): void
    {
        $this->updateSellIn();
        $this->updateQuality();
        $this->checkBoundary();
    }

    /**
     * 更新過期期限
     *
     * @return void
     */
    private function updateSellIn(): void
    {
        --$this->item->sellIn;
    }

    /**
     * 更新品質
     *
     * @return void
     */
    protected function updateQuality(): void
    {
        if ($this->item->sellIn < 0) {
            // 已過期，過期為雙倍變化
            $this->item->quality -= (2 * $this->qualityRate);
        }else{
            // 未過期
            $this->item->quality -= $this->qualityRate;
        }
    }

    /**
     * 檢查品質boundary
     *
     * @return void
     */
    private function checkBoundary(): void
    {
        $this->item->quality = max($this->minQuality, min($this->maxQuality, $this->item->quality));
    }
}