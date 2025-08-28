package com.gildedrose.updater;

import com.gildedrose.Item;

public class BackstagePassUpdater extends ItemUpdater {
    public BackstagePassUpdater(Item item) {
        super(item);
    }

    @Override
    public void update() {
        increaseQuality();
        if (item.sellIn < 11) {
            increaseQuality();
        }
        if (item.sellIn < 6) {
            increaseQuality();
        }
        decreaseSellIn();
        if (item.sellIn < 0) {
            item.quality = 0;
        }
    }
}
