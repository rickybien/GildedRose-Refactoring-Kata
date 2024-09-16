package com.max.strategypattern.strategy.impl

import com.gildedrose.Item
import com.gildedrose.Item.Companion.isExpired
import com.max.strategypattern.strategy.QualityStrategy

class MinusStrategy(private val quality: Int): QualityStrategy() {
    override fun updateQuality(item: Item) {
        item.sellIn = item.sellIn - 1
        item.quality = if (item.isExpired()) {
            item.quality - (quality * 2)
        } else {
            item.quality - quality
        }.let {
            if (isLessThanLowestQuality(it)) lowestQuality else it
        }
    }
}