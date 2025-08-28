package com.gildedrose

sealed class UpdateStrategy {
    open fun update(item: Item) {
        decreaseSellIn(item)
        updateQuality(item)
        if (item.sellIn < 0) {
            updateExpiredItemQuality(item)
        }
    }

    private fun decreaseSellIn(item: Item) {
        if (item.name != SULFURAS) {
            item.sellIn -= 1
        }
    }

    protected open fun updateQuality(item: Item) {
        decreaseQuality(item)
    }

    protected open fun updateExpiredItemQuality(item: Item) {
        decreaseQuality(item)
    }

    protected fun increaseQuality(item: Item) {
        if (item.quality < MAX_QUALITY) {
            item.quality += 1
        }
    }

    protected fun decreaseQuality(item: Item, decreaseValue: Int = 1) {
        if (item.quality > MIN_QUALITY && item.name != SULFURAS) {
            item.quality -= decreaseValue
        }
    }

    object NormalUpdateStrategy : UpdateStrategy() {
        override fun updateQuality(item: Item) {
            decreaseQuality(item)
        }

        override fun updateExpiredItemQuality(item: Item) {
            decreaseQuality(item)
        }
    }

    object AgedBrieUpdateStrategy : UpdateStrategy() {
        override fun updateQuality(item: Item) {
            increaseQuality(item)
        }

        override fun updateExpiredItemQuality(item: Item) {
            increaseQuality(item)
        }
    }

    object BackstagePassUpdateStrategy : UpdateStrategy() {
        override fun updateQuality(item: Item) {
            increaseQuality(item)
            if (item.sellIn < BACKSTAGE_PASS_THRESHOLD_1) {
                increaseQuality(item)
            }
            if (item.sellIn < BACKSTAGE_PASS_THRESHOLD_2) {
                increaseQuality(item)
            }
        }

        override fun updateExpiredItemQuality(item: Item) {
            item.quality = MIN_QUALITY
        }
    }

    object SulfurasUpdateStrategy : UpdateStrategy() {
        override fun update(item: Item) {}
    }

    object ConjuredUpdateStrategy : UpdateStrategy() {
        override fun updateQuality(item: Item) {
            decreaseQuality(item, 2)
        }

        override fun updateExpiredItemQuality(item: Item) {
            decreaseQuality(item, 2)
        }
    }
}