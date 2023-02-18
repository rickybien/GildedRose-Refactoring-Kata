package com.gildedrose

open class Item(var name: String, var sellIn: Int, var quality: Int) {
    override fun toString(): String {
        return this.name + ", " + this.sellIn + ", " + this.quality
    }

    companion object {
        fun Item.isExpired(): Boolean {
            return sellIn < 0
        }
    }
}