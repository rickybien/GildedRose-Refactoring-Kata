package com.gildedrose

class GildedRose(val items: Array<Item>) {

    fun updateQuality() {
        items.forEach { item ->
            val strategy = when (item.name) {
                AGED_BRIE -> UpdateStrategy.AgedBrieUpdateStrategy
                BACKSTAGE_PASSES -> UpdateStrategy.BackstagePassUpdateStrategy
                SULFURAS -> UpdateStrategy.SulfurasUpdateStrategy
                CONJURED -> UpdateStrategy.ConjuredUpdateStrategy
                else -> UpdateStrategy.NormalUpdateStrategy
            }
            strategy.update(item)
        }
    }
}

