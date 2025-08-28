package com.max.strategypattern.strategy

import com.gildedrose.Item

abstract class QualityStrategy {

    abstract fun updateQuality(item: Item)

    protected val highestQuality = HIGHEST_QUALITY
    protected val lowestQuality = LOWEST_QUALITY

    protected fun isHighThanHighestQuality(quality: Int): Boolean {
        return quality > HIGHEST_QUALITY
    }

    protected fun isLessThanLowestQuality(quality: Int): Boolean {
        return quality < LOWEST_QUALITY
    }

    companion object {
        private const val HIGHEST_QUALITY = 50
        private const val LOWEST_QUALITY = 0
    }
}