<?php
/**
 * Gilded Rose的Class
 *
 * @version 0.2.4
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/4
 * @since 0.1.0 2024/12/4 eden.chen: 新建立PHPDoc
 * @since 0.1.1 2024/12/4 eden.chen: 重構，替換常用常數
 * @since 0.1.2 2024/12/4 eden.chen: 重構，處理quality下降
 * @since 0.1.3 2024/12/4 eden.chen: 重構，處理過期物品
 * @since 0.2.0 2024/12/4 eden.chen: 增加Conjured規則
 * @since 0.2.1 2024/12/4 eden.chen: 補齊PHPDoc
 * @since 0.2.2 2024/12/4 eden.chen: 整個重構updateQuality
 * @since 0.2.3 2024/12/4 eden.chen: 更改==，變成===
 * @since 0.2.4 2024/12/5 eden.chen: 重構，將所有item拆分各個class
 */
declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\ItemFactory;

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
            ItemFactory::create($item)->triggerUpdateQuality();
        }
    }
}
