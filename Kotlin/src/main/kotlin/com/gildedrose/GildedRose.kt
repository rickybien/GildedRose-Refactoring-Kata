package com.gildedrose

class GildedRose(val items: Array<Item>) {

    companion object {
        private const val MAX_QUALITY = 50
        private const val MIN_QUALITY = 0

        private const val BACKSTAGE_PASS_THRESHOLD_1 = 11
        private const val BACKSTAGE_PASS_THRESHOLD_2 = 6

        private const val AGED_BRIE = "Aged Brie"
        private const val BACKSTAGE_PASSES = "Backstage passes to a TAFKAL80ETC concert"
        private const val SULFURAS = "Sulfuras, Hand of Ragnaros"
    }

    fun updateQuality() {
        items.forEach { item ->
            updateItemQuality(item)
            decreaseSellIn(item)
            if (item.sellIn < 0) {
                updateExpiredItemQuality(item)
            }
        }
    }

    private fun updateItemQuality(item: Item) {
        when (item.name) {
            AGED_BRIE -> increaseQuality(item)
            BACKSTAGE_PASSES -> updateBackstagePassQuality(item)
            SULFURAS -> return
            else -> decreaseQuality(item)
        }
    }

    private fun increaseQuality(item: Item) {
        if (item.quality < MAX_QUALITY) {
            item.quality += 1
        }
    }

    private fun decreaseQuality(item: Item) {
        if (item.quality > MIN_QUALITY && item.name != SULFURAS) {
            item.quality -= 1
        }
    }

    private fun updateBackstagePassQuality(item: Item) {
        increaseQuality(item)
        if (item.sellIn < BACKSTAGE_PASS_THRESHOLD_1) {
            increaseQuality(item)
        }
        if (item.sellIn < BACKSTAGE_PASS_THRESHOLD_2) {
            increaseQuality(item)
        }
    }

    private fun decreaseSellIn(item: Item) {
        if (item.name != SULFURAS) {
            item.sellIn -= 1
        }
    }

    private fun updateExpiredItemQuality(item: Item) {
        when (item.name) {
            AGED_BRIE -> increaseQuality(item)
            BACKSTAGE_PASSES -> item.quality = MIN_QUALITY
            else -> decreaseQuality(item)
        }
    }
}

