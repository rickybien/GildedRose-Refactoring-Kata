package com.gildedrose

class GildedRose(var items: Array<Item>) {

    private val qualityContext = QualityContext()

    fun updateQuality() {
        for (item in items) {
            when (item.name) {
                GildedRoseProductType.PLUS_5_DEXTERITY_VEST.itemName,
                GildedRoseProductType.ELIXIR_OF_THE_MONGOOSE.itemName -> {
                    qualityContext.setQualityStrategy(MinusStrategy(BASE_MINUS_QUALITY))
                }
                GildedRoseProductType.AGED_BRIE.itemName -> {
                    qualityContext.setQualityStrategy(PlusStrategy(BASE_PLUS_QUALITY))
                }
                GildedRoseProductType.BACKSTAGE_PASSES_TO_A_TAFKAL80ETC_CONCERT.itemName -> {
                    qualityContext.setQualityStrategy(Ticket80EtcConcertBackstagePassesStrategy())
                }
                GildedRoseProductType.SULFURAS_HAND_OF_RAGNAROS.itemName -> {
                }
                GildedRoseProductType.CONJURED_MANA_CAKE.itemName -> {
                    qualityContext.setQualityStrategy(MinusStrategy(BASE_MINUS_QUALITY * 2))
                }
            }

            qualityContext.updateQuality(item)
        }
    }

    companion object {
        private const val BASE_MINUS_QUALITY = 1
        private const val BASE_PLUS_QUALITY = 1
    }
}

