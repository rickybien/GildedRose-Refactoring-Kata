package com.max.strategypattern.strategy

import com.gildedrose.Item

class QualityContext {

    private var currentStrategy: QualityStrategy? = null

    fun setQualityStrategy(strategy: QualityStrategy) {
        currentStrategy = strategy
    }

    fun updateQuality(item: Item) {
        currentStrategy?.updateQuality(item)
        currentStrategy = null
    }
}