package com.max.strategypattern.strategy.impl

import com.gildedrose.Item
import com.gildedrose.Item.Companion.isExpired
import com.max.strategypattern.strategy.QualityStrategy

class PlusStrategy(private val quality: Int): QualityStrategy() {
    override fun updateQuality(item: Item) {
        item.sellIn = item.sellIn - 1
        item.quality = when {
            item.isExpired() -> {
                item.quality + (quality * 2)
            }
            else -> {
                item.quality + quality
            }
        }.run {
            if (isHighThanHighestQuality(this)) highestQuality else this
        }
    }
}