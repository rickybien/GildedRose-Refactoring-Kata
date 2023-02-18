package com.gildedrose

class GildedRose(var items: Array<Item>) {

    fun updateQuality() {
        items.forEach { item ->
            updateItemQuality(item)
            decreaseSellIn(item)
            item.takeIf { it.sellIn < 0 }?.apply {
                updateExpiredItemQuality(this)
            }
        }
    }


    private fun updateItemQuality(item: Item) {
        when (item.name) {
            "Aged Brie" -> increaseItemQuality(item)
            "Backstage passes to a TAFKAL80ETC concert" -> updateBackstagePassQuality(item)
            "Sulfuras, Hand of Ragnaros" -> return
            else -> decreaseItemQuality(item)
        }
    }

    private fun increaseItemQuality(item: Item) {
        if (item.quality < 50) {
            item.quality += 1
        }
    }


    private fun decreaseItemQuality(item: Item) {

        if (item.quality > 0) {
            item.quality -= 1
        }
    }


    private fun updateBackstagePassQuality(item: Item) {
        increaseItemQuality(item)
        if (item.sellIn < 11) {
            increaseItemQuality(item)
        }

        if (item.sellIn < 6) {
            increaseItemQuality(item)
        }
    }



    private fun decreaseSellIn(item: Item) {
        if (item.name != "Sulfuras, Hand of Ragnaros") {
            item.sellIn -= 1
        }
    }


    private fun updateExpiredItemQuality(item: Item) {
        when (item.name) {
            "Aged Brie" -> increaseItemQuality(item)
            "Backstage passes to a TAFKAL80ETC concert" -> item.quality = 0
            else -> decreaseItemQuality(item)
        }
    }
}

