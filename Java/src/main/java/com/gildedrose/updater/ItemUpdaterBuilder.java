package com.gildedrose.updater;

import com.gildedrose.Item;

public class ItemUpdaterBuilder {
    private Item item;

    public ItemUpdaterBuilder setItem(Item item) {
        this.item = item;
        return this;
    }

    public ItemUpdater build() {
        switch (item.name) {
            case "Aged Brie":
                return new AgedBrieUpdater(item);
            case "Sulfuras, Hand of Ragnaros":
                return new SulfurasUpdater(item);
            case "Backstage passes to a TAFKAL80ETC concert":
                return new BackstagePassUpdater(item);
            case "Conjured":
                return new ConjuredUpdater(item);
            default:
                return new NormalItemUpdater(item);
        }
    }
}
