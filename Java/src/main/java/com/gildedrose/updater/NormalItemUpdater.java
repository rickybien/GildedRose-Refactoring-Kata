package com.gildedrose.updater;

import com.gildedrose.Item;

public class NormalItemUpdater extends ItemUpdater {
    public NormalItemUpdater(Item item) {
        super(item);
    }

    @Override
    public void update() {
        decreaseQuality();
        decreaseSellIn();
        if (item.sellIn < 0) {
            decreaseQuality();
        }
    }
}
