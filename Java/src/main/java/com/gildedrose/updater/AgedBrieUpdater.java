package com.gildedrose.updater;

import com.gildedrose.Item;

public class AgedBrieUpdater extends ItemUpdater {
    public AgedBrieUpdater(Item item) {
        super(item);
    }

    @Override
    public void update() {
        increaseQuality();
        decreaseSellIn();
        if (item.sellIn < 0) {
            increaseQuality();
        }
    }
}
